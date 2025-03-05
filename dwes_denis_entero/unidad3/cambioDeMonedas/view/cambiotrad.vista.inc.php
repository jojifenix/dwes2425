<?php
require_once "data/cambiotrad.inc.php";
class Vista{
    public $l;
    public function __construct(){
        $this->l = isset($_SESSION['lang']) ? LANGS[$_SESSION['lang']] : LANGS['es'];
    }
    public function getLang(){
        return $this->l;
    }
    public function setLang($lang) {
        $this->l = LANGS[$lang];
    }
    public function formLang(){
        echo '<form method="post" action="' . $_SERVER["PHP_SELF"] . '">

                <div class="div1">
                    <p class="pform">' . $this->l["choose_lang"] .
                        '<select name="lang">';

                            foreach (LANGS as $k => $fila) {
                                echo '<option value="' . $k . '">' . $fila["name"] . '</option>';
                            }

                        echo '</select><br/></p> 
                    <input class ="enviar" type="submit" name="btn_lang" value="' . $this->l["btn_trad"] . '">
                </div>

            </form>';
    }
    public function form(){
        echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">

                <div class="div1">
                    <p class="pform">' . $this->l["cantidad"] . '</p><br />
                    <input class="cant" type="string" name="cant"> <br />
                </div>
                <div class="div2">
                    <p class="pform">' . $this->l["convertira"] . '
                        <select name="moneda">';
                        foreach (VALS as $k => $fila) {
                            echo '<option value="' . $k . '">' . $this->l[$k] . '</option>';
                        }
                        echo '</select>
                    </p><br/>
                    <input class="enviar" type="submit" name="Cambiar" value="' . $this->l["cambiar"] . '">
                </div>

            </form>';
    }
    public function error(){
        echo "<p>" . $this->l["error"] . "</p>";
        $this->volver(); 
    }
    public function mensaje($cant, $mon){
        $cambio = $cant * $mon["tipo"];
        echo "<p class='pphp'>" . $cant . " " . $this->l["mensaje1"] . $cambio . " " . $mon["literal"] . "</p>";
        $this->volver();
    }
    public function volver(){
        echo "<p class='pphp'><a href='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>" . $this->l["volver"] . "</a></p>";
        echo "<p class='pphp'><a href='end_session.php'>" . $this->l["finalizar"] . "</a></p>";
    }
    public function validar($cant){
        if (!is_numeric($cant) || $cant < 0) {
            echo "<p class='pphp'>" . $this->l["error1"] . "</p>";
            $this->volver();
            return false;
        } elseif ($cant > MAX_CANT) {
            echo "<p class='pphp'>" . $this->l["error2"] . "</p>";
            $this->volver();
            return false;
        }
        return true;
    }
}
