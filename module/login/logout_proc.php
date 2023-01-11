<?php
session_start();

unset($_SESSION["ses_member_email"]);
unset($_SESSION["ses_member_name"]);
unset($_SESSION["ses_member_type"]);
unset($_SESSION["ses_member_site"]);

header("Location:/");
