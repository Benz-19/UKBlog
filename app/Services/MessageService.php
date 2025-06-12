<?php

namespace App\Services;

/**
 * Class MessageService
 * Handles all kinds of messaging by storing status messages in the session.
 * This service provides a centralized way to set success, pending, or error messages.
 */

class MessageService
{

    /**
     * Stores a status message of a specific type in the PHP session.
     *
     * @param string $type The type of the message (e.g., 'success', 'pending', 'error').
     * This determines which session variable will be set.
     * @param string $msg  The actual message content to be stored.
     * @return void
     */

    public static function message(string $type, string $msg)
    {
        if ($type === 'success') {
            $_SESSION['success'] = $msg;
        } elseif ($type === 'pending') {
            $_SESSION['pending'] = $msg; //for a pending message status
        } else {
            $_SESSION['error'] = $msg;
            error_log($_SESSION['error']);
        }
    }
}
