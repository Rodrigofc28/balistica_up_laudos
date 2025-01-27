<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Bellnotification extends Notification
{
    use Queueable;

    // Propriedade para armazenar a mensagem
    protected $mensagem;

    /**
     * Cria uma nova instância de notificação.
     *
     * @param string $mensagem
     * @return void
     */
    public function __construct($mensagem)
    {
        // Inicializa a propriedade com o valor passado
        $this->mensagem = $mensagem;
    }

    /**
     * Obtém os canais de entrega da notificação.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database']; // Canal de notificação
    }

    /**
     * Obtém a representação em array da notificação.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // Passa a mensagem para o array de dados que será armazenado
        return [
            'mensagem' => $this->mensagem, // Aqui acessamos a propriedade corretamente
        ];
    }
}

