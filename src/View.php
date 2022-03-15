<?php


class View
{
    private string $layout;
    public array $data;

    public function __construct(string $layout) {
        $this->layout = $layout;
    }

    public function add($placeholder, $html) {
        $this->data[$placeholder] = $html;
    }

    public function render_nav() {
        $this->add(':logout', isset($_SESSION['user']) ? "<a href='index.php?controller=auth&action=logout'>Uitloggen</a>": "");
        $this->add(':register', !isset($_SESSION['user']) ? "<a href='index.php?controller=auth&action=register'>Register</a>": "");
        $this->add(':login', isset($_SESSION['user']) ? '<span>'.ucfirst($_SESSION['user']['email']).'</span>':"<a href='index.php?controller=auth&action=login'>Login</a>");
        $this->add(':messages', !isset($_SESSION['user']) ? '':"<a href='index.php?controller=message&action=index'>Messages</a>");
        $this->add(':newmessage', !isset($_SESSION['user']) ? 'bla':"<a href='index.php?controller=message&action=newmessage'>New Message</a>");

    }

    public function render_table($class, $data) {
        $html = "<table class='$class'>\n";
        foreach($data as $tr) {
            $html .= "\t<tr>\n";
            foreach($tr as $td) {
                $html .= "\t\t<td>".$td."</td>\n";
            }
            $html .= "\t</tr>\n";
        }
        $html .= "</table>\n";
        return $html;
    }

    public function render_list($class, $data) {
        $html = "<ul>\n";
        foreach($data as $li) {
            $html .= "\t<li>".$li."</li>\n";
        }
        $html .= "</ul>\n";
    }

    public function render() {
        $this->render_nav();
        $page = file_get_contents($this->layout);
        echo strtr($page, $this->data);
    }
}