<?php
    $isPartial = empty($_POST['partial']) ? false : true;

    // A preset set of messages
    $messages = array(
        'required' => 'The field %s is required',
        'invalid' => 'The field %s is invalid',
        'errors' => 'Please fix the errors in the form to continue',
        'generic' => 'An error has occurred and your message has not been delivered. Try later %s',
        'short' => 'The value of the field %s is too short. It must have at least %d characters',
        'success' => 'Thank you for your message %s. It has been successfully sent'
    );

    // The result of the request
    $result = array(
        'status' => '',
        'message' => '',
        'info' => []
    );

    // Check Full name
    if (!$isPartial && $_POST['name'] === '') {
        $result['info'][] = array(
            'field' => 'name',
            'message' => sprintf($messages['required'], 'Full name')
        );
    } else if ((!$isPartial || isset($_POST['name'])) && strlen($_POST['name']) <= 3) {
        $result['info'][] = array(
            'field' => 'name',
            'message' => sprintf($messages['short'], 'Full name', 4)
        );
    }

    // Check Email
    if (!$isPartial && $_POST['email'] === '') {
        $result['info'][] = array(
            'field' => 'email',
            'message' => sprintf($messages['required'], 'Email')
        );
    } else if ((!$isPartial || isset($_POST['email'])) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $result['info'][] = array(
            'field' => 'email',
            'message' => sprintf($messages['invalid'], 'Email')
        );
    }

    // Check Subject
    if (!$isPartial && $_POST['subject'] === '') {
        $result['info'][] = array(
            'field' => 'subject',
            'message' => sprintf($messages['required'], 'Subject')
        );
    } else if ((!$isPartial || isset($_POST['subject'])) && strlen($_POST['subject']) <= 3) {
        $result['info'][] = array(
            'field' => 'subject',
            'message' => sprintf($messages['short'], 'Subject', 4)
        );
    }

    // Check Message
    if (!$isPartial && $_POST['message'] === '') {
        $result['info'][] = array(
            'field' => 'message',
            'message' => sprintf($messages['required'], 'Message')
        );
    } else if ((!$isPartial || isset($_POST['message'])) && strlen($_POST['message']) <= 3) {
        $result['info'][] = array(
            'field' => 'message',
            'message' => sprintf($messages['short'], 'Message', 4)
        );
    }

    if (!empty($result['info'])) {
        $result['status'] = 'error';
        $result['message'] = $messages['errors'];
    } else {
        /*
         * If you have a SMTP server on your computer uncomment
         * these lines and remove the `if(true) {` line.
         *
         *
         * if (mail(
         *    'youremail@domain.com',
         *    htmlentities($_POST['subject']),
         *    htmlentities($_POST['message']),
         *    'From: ' . $_POST['name'] . ' <' . $_POST['email'] . '>'
         * )) {
         */
        if (true) {
            $result['status'] = 'success';
            if ($isPartial) {
                $result['message'] = '';
            } else {
                // Sorry if the htmlentities function sounds unfamiliar to you,
                // but as a programmer I just can leave this statement subject to XSS attacks
                $result['message'] = sprintf($messages['success'], htmlentities($_POST['name']));
            }
        } else {
            $result['status'] = 'error';
            $result['message'] = sprintf($messages['generic'], htmlentities($_POST['name']));
        }
    }

    echo json_encode($result);