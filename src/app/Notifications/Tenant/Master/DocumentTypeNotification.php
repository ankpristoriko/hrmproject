<?php

namespace App\Notifications\Tenant\Master;

use App\Mail\Tag\DocumentTypeTag;
use App\Notifications\BaseNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class DocumentTypeNotification extends BaseNotification implements ShouldQueue
{
    use Queueable;

    public function __construct($templates, $via, $documenttype)
    {
        $this->templates = $templates;
        $this->via = $via;
        $this->model = $documenttype;
        $this->auth = auth()->user();
        $this->tag = DocumentTypeTag::class;
        parent::__construct();
    }

    public function parseNotification()
    {
        $this->mailView = 'documenttype';
        $this->databaseNotificationUrl = route(config('notification.document_type_front_end_route_name'), [
            'documenttype' => $this->model->id
        ]);

        $this->mailSubject = $this->template()->mail()->parseSubject([
            '{name}' => $this->model->name
        ]);

        $this->databaseNotificationContent = $this->template()->database()->parse([
            '{name}' => $this->model->name
        ]);
    }
}