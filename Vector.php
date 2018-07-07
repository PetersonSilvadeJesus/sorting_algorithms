<?php
/**
 * Created by PhpStorm.
 * User: peterson
 * Date: 14/06/18
 * Time: 00:33
 */

class Vector
{
    public static function choose_vector()
    {
        $html = "<div class=\"row\">
                <div class=\"container col-md-5\">
                    <div class=\"col-md-12\">
                        Choose the insertion type of vector:
                    </div>
                    <div class=\"col-md-6\">
                        <select id=\"choose_type\" class=\"form-control\">
                            <option value=\"rand\">Rand</option>
                            <option value=\"file\">File</option>
                            <option value=\"enter\">Enter</option>
                        </select>
                    </div>
                </div>
            
                <div class=\"form-group col-md-7\">
                    <input type='file' id=\"file_input\" accept='text/plain' onchange='openFile(event)'
                           style=\"display: none;\"><br>
                    <div class=\"row\">
            
                        <div class=\"col-md-6\" id=\"div_file\" style=\"display: none;\">
                            <b>Choose the file with vector: </b><br>
                            <small class=\"form-text text-muted\">( Please, separate the numbers by space. )</small> <br>
                            <button class=\"btn btn-warning\" id=\"file_click\"><i class=\"fa fa-upload\"></i> File</button>
                            <br><br>
                        </div>
                        <div class=\"col-md-12\" id=\"div_rand\">
                            ";

        if($_GET['exe'] == 'heap' || $_GET['exe'] == 'merge'){

            $html .= "Enter the numbers size have the vector <select id='range_count' class='form-control'> ";

            for ($i = 1; $i <= 15; $i++) {
                $html .= "<option value=" . $i . ">" . $i . "</option>";
            }

            $html .= "</select>";
        }else{
            $html .= "<input type='number' class='form-control' id='range_count' placeholder='Enter the numbers size have the vector'>";
        }

        $html .= "<br><br>
                        </div>
                        <div class=\"col-md-12\" id=\"div_enter\" style=\"display: none;\">
                            <input type=\"text\" id='input_enter' class=\"form-control\" placeholder=\"Enter the numbers count have the vector\"><br>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            
             ";

        return $html;
    }

    public static function buttons()
    {
        return "<div class=\"buttons\" style=\"float:right\">
            <button id=\"start\" style=\"display: none\" class=\"btn btn-success\">Start</button>
            <button id=\"sort\" style=\"display: none\" class=\"btn btn-primary\">Sort</button>
            <button id=\"swap\" style=\"display: none\" class=\"btn btn-primary\">Swap</button>
            <button id=\"next\" style=\"display: none\" class=\"btn btn-warning\">Next</button>
            <button id=\"start_application\" class='btn btn-success'>Start Application</button>
            <button id=\"all\" style=\"display: none\" class=\"btn btn-danger\">Complete Everything</button>
            <button id=\"reflash\" class=\"btn btn-dark\">Reflash</button>
        </div>";
    }

    public static function message(array $messages)
    {
        $html = "<div class='alert alert-info container-fluid'>";
        $html .= "<b>[HELP] </b><br>";

        foreach ($messages as $key => $message) {
            $html .= "<a style='color: {$key}'>{$key}</a>: {$message}.<br>";
        }
        $html .= "</div>";
        return $html;
    }
}