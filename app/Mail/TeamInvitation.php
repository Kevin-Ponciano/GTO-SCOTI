<?php

namespace App\Mail;

use App\Models\TeamInvitation as TeamInvitationModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;


class TeamInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The team invitation instance.
     *
     * @var TeamInvitationModel
     */
    public $invitation;

    /**
     * Create a new message instance.
     *
     * @param TeamInvitationModel $invitation
     * @return void
     */
    public function __construct(TeamInvitationModel $invitation)
    {
        $this->invitation = $invitation;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $url = URL::signedRoute('team-invitations.accept',
            [
                'invitation' => $this->invitation,
            ]);

        TeamInvitationModel::where('email', $this->invitation->email)->update(['url' => $url]);

        return $this->markdown('jetstream::mail.team-invitation', ['acceptUrl' => $url])->subject(__('Team Invitation'));
    }
}
