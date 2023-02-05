<?php

namespace App\Services\Integrations\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Models\CORE\MasterEmailTemplate;
use App\Services\Generals\Constants\CTIE;
use App\Services\Generals\Helpers\Strings;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Services\Generals\Constants\GeneralStatus;
use Illuminate\Notifications\Messages\MailMessage;

class EmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $data;
    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct(array $data)
    {
        $this->data = $data;

        $masterEmailTemplate =
            MasterEmailTemplate::where('category_id', $data['category_id'])->where('school_id', $data['school_id'])->where('status', GeneralStatus::ACTIVE)->exists()
            ?
            MasterEmailTemplate::where('category_id', $data['category_id'])->where('school_id', $data['school_id'])->where('status', GeneralStatus::ACTIVE)->first()
            :
            MasterEmailTemplate::where('category_id', $data['category_id'])->where('school_id', CTIE::ID)->where('status', GeneralStatus::ACTIVE)->first();

        if ($masterEmailTemplate) {
            $email_content = $masterEmailTemplate->email_content;
            Strings::replace($email_content, $this->data['arrayOfStringToReplace']);

            $this->data['subject'] = $masterEmailTemplate->email_name;
            $this->data['content'] = $email_content;
        }
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (isset($this->data['content'])) {
            return (new MailMessage)->view('email.masterContent', ['content' => $this->data['content']])->subject($this->data['subject']);
        } else {
            return (new MailMessage)
                ->greeting('Hello!')
                ->line('How are you?');
        }
    }

    public function failed(Exception $exception)
    {
        Log::channel('mail')->emergency('Critical job Failed! - ' . $exception->getMessage());
    }
}
