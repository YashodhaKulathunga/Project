<?php
class User {
    private $userName;
    private $password;
    private $userID;
    private $name;
    private $email;

    public function __construct($userName, $password, $userID, $name, $email) {
        $this->userName = $userName;
        $this->password = $password;
        $this->userID = $userID;
        $this->name = $name;
        $this->email = $email;
    }

    public function logIn($enteredUserName, $enteredPassword) {
        if ($enteredUserName === $this->userName && $enteredPassword === $this->password) {
            return "Login successful";
        } else {
            return "Login failed";
        }
    }

    public function updateProfile($newName, $newEmail) {
        $this->name = $newName;
        $this->email = $newEmail;
        return "Profile updated";
    }

    public function giveFeedback($feedbackMessage) {
        // Process and store the feedback
        return "Feedback submitted: " . $feedbackMessage;
    }
}