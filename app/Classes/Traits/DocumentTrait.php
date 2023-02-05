<?php

namespace App\Classes\Traits;

use App\Models\SIS\BillingInvoice;
use App\Services\Generals\Helpers\Strings;
use App\Services\Generals\Helpers\Templates;
use App\Services\Generals\Constants\DocumentType;
use App\Services\Generals\Helpers\TemplateInvoices;
use App\Services\Modules\GENERAL\Documents\DataTransferObjects\DocumentRequestObject;

trait DocumentTrait
{
    protected function createDocument($entity_type, $entity_id, $entity_document_type, $entity_document_category_id, $arrayOfStringToReplace = null, $id = null)
    {
        if($entity_document_type == DocumentType::EMAIL){
            $documentType = app('App\Services\Modules\CORE\Masters\SubModules\EmailTemplates\Processors\MasterEmailTemplateShowProcessor')->execute([
                'with' => ['school.schoolLogo'],
                'conditions' => [
                    'category_id' => $entity_document_category_id
                ]
            ]);
            $content = $documentType->email_content;
            $template_design_id = $documentType->template_design_id;
        }elseif($entity_document_type == DocumentType::LETTER){
            $documentType = app('App\Services\Modules\CORE\Masters\SubModules\LetterTemplates\Processors\MasterLetterTemplateShowProcessor')->execute([
                'with' => ['school.schoolLogo'],
                'conditions' => [
                    'id' => $entity_id,
                    'category_id' => $entity_document_category_id
                ]
            ]);
            $content = $documentType->letter_content;
            $template_design_id = $documentType->template_design_id;
        }elseif($entity_document_type == DocumentType::INVOICE){
            $documentType = app('App\Services\Modules\SIS\Billings\SubModules\BillingCreateInvoice\Processors\BillingCreateInvoiceShowProcessor')->execute([
                'with' => ['school.schoolLogo'],
                'conditions' => [
                    'id' => $entity_id
                ]
            ]);
            $content = TemplateInvoices::generateItemTable($documentType);
            $template_design_id = $documentType->configInvoiceFormat->template_design_id;
        }elseif($entity_document_type == DocumentType::RECEIPT){
            
        }

        $templateData = Templates::defaultReplace($template_design_id, $documentType->school);

        if($entity_document_type == DocumentType::INVOICE){
            $templateData = TemplateInvoices::defaultReplace($documentType, $templateData);
        }

        if($arrayOfStringToReplace){
            Strings::replace($content, $arrayOfStringToReplace);
        }
        Strings::replace($templateData['body'], ['content' => $content]);

        $templateData = (object) $templateData;

        $documentRequestObject = new DocumentRequestObject([
            'entity_id' => $entity_id,
            'entity_type' => $entity_type,
            'entity_document_type' => $entity_document_type,
            'entity_document_category_id' => $entity_document_category_id,
            'styles' => $templateData->styles,
            'header' => $templateData->header,
            'body_header' => $templateData->body_header,
            'body' => $templateData->body,
            'body_column_1' => $templateData->body_column_1,
            'body_column_2' => $templateData->body_column_2,
            'body_footer' => $templateData->body_footer,
            'footer' => $templateData->footer
        ]);

        if($id){
            $documentRequestObject->id = $id;
        }

        app('App\Services\Modules\GENERAL\Documents\Processors\DocumentStoreProcessor')->execute($documentRequestObject);
    }
}