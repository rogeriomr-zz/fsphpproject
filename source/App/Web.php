<?php


namespace Source\App;


use Source\Core\Controller;

/**
 * Web Controller
 * @package Source\App
 */
class Web extends Controller
{
    /**
     * Web constructor.
     */
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
    }

    /**
     *  SITE HOME
     */
    public function home(): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " - " . CONF_SITE_TITLE,
            CONF_SITE_DESC,
            url(),
            url("/assets/images/share.jps")
        );

        echo $this->view->render("home", [
            "head" => $head,
            "video" => "lDZGl9Wdc7Y"
        ]);
    }

    /**
     * SITE NAV ERROR
     * @param array $data
     */
    public function error(array $data): void
    {
        $error = new \stdClass();
        $error->code = $data['errcode'];
        $error->title = "Ooops. Conteúdo indisponível :/";
        $error->message = "Sentimos muito, mas o conteúdo que você tentou acessar não eciste, está indisponível no momento ou foi removido :/";
        $error->linkTitle = "Continue navegando!";
        $error->link = url_back();

        $head = $this->seo->render(
            "{$error->code}" | "{$error->title}",
            $error->message,
            url_back("/ops/{$error->code}"),
            url("/assets/images/share.jps"),
            false
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => $error
        ]);
    }
}