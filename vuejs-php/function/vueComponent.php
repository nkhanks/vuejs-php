<?php

class vueComponent {

    var $component;

    function extractTemplate($script) {
        $this->component->template = "";
        if (preg_match("/<template(.*?)>(.*?)<\/template>/ms", $script)) {
            preg_match("/<template(.*?)>(.*?)<\/template>/ms", $script, $matches, PREG_OFFSET_CAPTURE, 0);
            $this->component->template = $matches[2][0];
            return preg_replace("/<template(.*?)>(.*?)<\/template>/ms", "", $script);
        }
        return $script;
    }

    function extractScript($script) {
        $this->component->js = "}";
        if (preg_match("/<script(.*?)>(.*?)<\/script>/ms", $script)) {
            preg_match("/<script(.*?)>(.*?)<\/script>/ms", $script, $matches, PREG_OFFSET_CAPTURE, 0);

            $js = $this->extractImport($matches[2][0]);

            $this->component->js = preg_replace("/.*export.*default.*{/m", "", $js);
            return preg_replace("/<script(.*?)>(.*?)<\/script>/ms", "", $script);
            ;
        }
        return $script;
    }

    function extractCSS($script) {
        $this->component->style = "";
        if (preg_match("/<style(.*?)>(.*?)<\/style>/ms", $script)) {
            preg_match("/<style(.*?)>(.*?)<\/style>/ms", $script, $matches, PREG_OFFSET_CAPTURE, 0);

            $this->component->style = $matches[2][0];
            return preg_replace("/<style(.*?)>(.*?)<\/style>/ms", "", $script);
        }
        return $script;
    }

    function extractImport($script) {
        preg_match_all("/.*import.*from(.*)/m", $script, $matches, PREG_OFFSET_CAPTURE, 0);

        foreach ($matches[1] as $import) {
            $newComponent = new vueComponent();
            $newComponent->setComponent(preg_replace('/["\']/', "", trim($import[0])));
            $this->component->components[] = $newComponent->getComponent();
        }

        return preg_replace("/.*import.*from(.*)/m", "", $script);
    }

    function setComponent($filename) {
        if (file_exists($filename)) {
            $script = file_get_contents($filename);
            $this->component = new stdClass();
            $this->component->isComponent = true;
            $this->component->name = pathinfo($filename, PATHINFO_FILENAME);
            ;
            $script = $this->extractTemplate($script);
 
            $script = $this->extractScript($script);

            $script = $this->extractCSS($script);
        } else {
            $this->component = new stdClass();
            $this->component->isComponent = false;
        }
    }

    function getComponent() {
        return $this->component;
    }

    function convertJS($filename) {
        $this->setComponent($filename);

        return $this->createJS($this->component);
    }
    
    function convertCSS($filename) {
        $this->setComponent($filename);

        
        return $this->createCSS($this->component);
    }

    function isError() {
        //TO DO
    }

    function checkDuplicate($filename) {
        //TO DO
    }

    function checkSyntax($filename) {
        //TO DO
    }

    function createJS($component) {
        $js = "\n /** VUE COMPONENT **/";
        if ($component->isComponent) {
            $js .= "\n Vue.component('{$component->name}',"
                    . "{"
                    . "template: `{$component->template}`,"
                    . "{$component->js}"
                    . ");\n";
            if (!empty($component->components)) {
                foreach ($component->components as $com) {
                    $js .= $this->createJS($com);
                }
            }
        }
        return $js;
    }
    
     function createCSS($component) {
        $css = "\n";
        if ($component->isComponent) {
            $css .= "\n {$component->style} ";
            if (!empty($component->components)) {
                foreach ($component->components as $com) {
                    $css .= $this->createCSS($com);
                }
            }
        }
        return $css;
    }

}
?>



