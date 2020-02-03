<?php

namespace App\Plugins;

class PluginFunctions
{
    protected $plugins = [];

    function __construct() {
        foreach (glob('../app/Plugins/*_plugin.php') as $file) {
            $this->register_plugin($file);
        }
    }

    public function register_plugin($plugin) {
        require_once($plugin);
        $this->plugins[] = basename($plugin, "_plugin.php");
    }

    public function get_custom_buttons() {
        $functions = [];

        foreach($this->plugins as $plugin) {

            $function = $plugin."_customButtonArray";

            $functions = array_merge($functions, $function());
        }

        return $functions;
    }

    public function get_custom_command($command) {
        $functions = [];
        
        foreach($this->plugins as $plugin) {

            $function = $plugin."_customButtonArray";

            foreach($function() as $func) {
                if($command == $func) {
                    if(function_exists($plugin."_".$func)) {
                        return $plugin."_".$func;
                    }
                }
            }
        }
    }
}
