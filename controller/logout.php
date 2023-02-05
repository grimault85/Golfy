<?php
if (Session::isConnected()) {
    Session::destroy();
}
