<?php


class View
{
    private string $layout;
    private array $data;

    public function __construct(string $layout) {
        $this->layout = $layout;
    }

    public function add($placeholder, $html) {
        $this->data[$placeholder] = $html;
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
        $page = file_get_contents($this->layout);
        echo strtr($page, $this->data);
    }
}