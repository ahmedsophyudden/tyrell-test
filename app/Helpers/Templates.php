<?php

namespace App\Services\Generals\Helpers;

use Auth;
use App\Models\CORE\School;
use Illuminate\Support\Facades\View;
use App\Models\CORE\MasterTemplateDesign;
use App\Services\Generals\Constants\TemplateVariable;

class Templates
{
    /**
     * @param $template_design_id
     * @param $school
     */
    public static function defaultReplace($template_design_id, $school = null)
    {
        $masterTemplateDesign = MasterTemplateDesign::find($template_design_id);

        if (!$school) {
            $school = School::find(Auth::user()->currentSchoolId());
        }

        $company = $school->company;

        $defaultData = [
            'school_id' => $school->id,
            'school_name' => $school->name,
            'school_logo' => $school->schoolLogo ? $school->schoolLogo->file_path : '',
            'school_contact_email' => $school->contact_email,
            'school_contact_phone' => $school->contact_phone,
            'school_website_url' => $school->website_url,
            'school_address_1' => $school->address ? $school->address->address_1 : '',
            'school_address_2' => $school->address ? $school->address->address_2 : '',
            'school_city_name' => $school->address ? $school->address->city_name : '',
            'school_postcode' => $school->address ? $school->address->postcode : '',
            'school_state_name' => $school->address ? $school->address->state_name : '',
            'school_country_name' => $school->address ? $school->address->country->name : '',

            'company_name' => $company ? $company->name : '',
            'company_no' => $company ? $company->company_no : '',
            'company_bank_name' => $company ? $company->bank_name : '',
            'company_bank_account_name' => $company ? $company->bank_account_name : '',
            'company_bank_account_no' => $company ? $company->bank_account_no : '',
            'company_contact_email' => $company ? $company->contact_email : '',
            'company_contact_phone' => $company ? $company->contact_phone : '',
            'company_website_url' => $company ? $company->website_url : '',
            'company_address_1' => $company && $company->address ? $company->address->address_1 : '',
            'company_address_2' => $company && $company->address ? $company->address->address_2 : '',
            'company_city_name' => $company && $company->address ? $company->address->city_name : '',
            'company_postcode' => $company && $company->address ? $company->address->postcode : '',
            'company_state_name' => $company && $company->address ? $company->address->state_name : '',
            'company_country_name' => $company && $company->address ? $company->address->country->name : '',

            'schoolscan_url' => config('app.subdomain') . '.' . config('app.domain'),
        ];

        $header = $masterTemplateDesign->header;
        if ($header) Strings::replace($header, $defaultData);

        $body_header = $masterTemplateDesign->body_header;
        if ($body_header) Strings::replace($body_header, $defaultData);

        $body = $masterTemplateDesign->body;
        if ($body) Strings::replace($body, $defaultData);

        $body_column_1 = $masterTemplateDesign->body_column_1;
        if ($body_column_1) Strings::replace($body_column_1, $defaultData);

        $body_column_2 = $masterTemplateDesign->body_column_2;
        if ($body_column_2) Strings::replace($body_column_2, $defaultData);

        $body_footer = $masterTemplateDesign->body_footer;
        if ($body_footer) Strings::replace($body_footer, $defaultData);

        $footer = $masterTemplateDesign->footer;
        if ($footer) Strings::replace($footer, $defaultData);

        return [
            'styles' => $masterTemplateDesign->styles,
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
