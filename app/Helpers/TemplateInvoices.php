<?php

namespace App\Services\Generals\Helpers;

use Auth;
use App\Models\CORE\School;
use App\Models\SIS\BillingInvoice;
use Illuminate\Support\Facades\View;
use App\Models\CORE\MasterTemplateDesign;
use App\Services\Generals\Constants\TemplateVariable;

class TemplateInvoices
{
    public static function generateItemTable(BillingInvoice $billingInvoice){
        
        $content = '<table border="0" style="width:100%" class="invoice-item">
            <tr class="row-header">
              <th class="description-title">DESCRIPTION</th>
              <th class="debit-title">DEBIT (RM)</th>
              <th class="credit-title">CREDIT (RM)</th>
            </tr>';

        foreach($billingInvoice->invoiceDetail as $invoice_detail){
            $content .= '<tr class="row-item">
              <td class="description-item">'.$invoice_detail->item_name.'</td>';
            
            if($invoice_detail->item_type == 'DR'){
                $content .= '<td class="debit-item">'.$invoice_detail->item_amount.'</td>
                <td class="credit-item"></td>';
            }else{
                $content .= '<td class="debit-item"></td>
                <td class="credit-item">'.$invoice_detail->item_amount.'</td>';
            }
            
            $content .= '</tr>';
        }

        $content .= '</table>';

        return $content;
    }

    /**
     * @param $template_design_id
     * @param $school
     */
    public static function defaultReplace(BillingInvoice $billingInvoice, $templateData)
    {

        $arrayOfStringToReplace = [
            'invoice_no' => $billingInvoice->invoice_no,
            'invoice_date' => $billingInvoice->issue_date,
            'invoice_total' => $billingInvoice->amount,
            'student_no' => $billingInvoice->schoolUser->school_identification_no,
            'student_name' => $billingInvoice->schoolUser->user->name,
            'student_address_1' => '',
            'student_address_2' => '',
            'student_city_name' => '',
            'student_postcode' => '',
            'student_state_name' => '',
            'student_country_name' => '',
            'student_academic_year' => '',
            'student_term' => '',
            'student_program' => '',
            'student_level' => '',
            'student_class' => '',
        ];

        $header = $templateData['header'];
        if ($header) Strings::replace($header, $arrayOfStringToReplace);

        $body_header = $templateData['body_header'];
        if ($body_header) Strings::replace($body_header, $arrayOfStringToReplace);

        $body = $templateData['body'];
        if ($body) Strings::replace($body, $arrayOfStringToReplace);

        $body_column_1 = $templateData['body_column_1'];
        if ($body_column_1) Strings::replace($body_column_1, $arrayOfStringToReplace);

        $body_column_2 = $templateData['body_column_2'];
        if ($body_column_2) Strings::replace($body_column_2, $arrayOfStringToReplace);

        $body_footer = $templateData['body_footer'];
        if ($body_footer) Strings::replace($body_footer, $arrayOfStringToReplace);

        $footer = $templateData['footer'];
        if ($footer) Strings::replace($footer, $arrayOfStringToReplace);

        return [
            'styles' => $templateData['styles'],
            'header' => $header,
            'body_header' => $body_header,
            'body' => $body,
            'body_column_1' => $body_column_1,
            'body_column_2' => $body_column_2,
            'body_footer' => $body_footer,
            'footer' => $footer
        ];
    }

    /**
     * @param String &$body
     * @param String &$content
     * @param Array $arrayOfStringToReplace
     */
    public static function contentReplace(String &$body, String &$content, array $arrayOfStringToReplace = [], String $prefix = '%', String $suffix = '%')
    {
        if (empty($arrayOfStringToReplace)) {
            foreach (TemplateVariable::LIST as $key => $data) {
                $arrayOfStringToReplace[$key] = $data['value'];
            }
        }

        Strings::replace($content, $arrayOfStringToReplace, $prefix, $suffix);
        Strings::replace($body, ['content' => $content], $prefix, $suffix);
    }


    /**
     * @param Array $data
     */
    public static function makeData($model)
    {
        return [
            'styles' => $model->styles,
            'header' => $model->header,
            'body_header' => $model->body_header,
            'body' => $model->body,
            'body_column_1' => $model->body_column_1,
            'body_column_2' => $model->body_column_2,
            'body_footer' => $model->body_footer,
            'footer' => $model->footer
        ];
    }


    /**
     * @param Array $data
     */
    public static function makeView($data)
    {
        $view = View::make('templateDesign.template', $data);
        return $view->render();
    }
}
