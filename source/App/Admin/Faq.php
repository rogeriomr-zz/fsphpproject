<?php
namespace Source\App\Admin;

use Source\Models\Faq\Channel;
use Source\Support\Pager;

/**
 * Class Faq
 * @package Source\App\Admin
 */
class Faq extends Admin
{
    /**
     * Faq constructor.
     */
    public function __contruct()
    {
        parent::__contruct();
    }

    /**
     * @param array|null $data
     */
    public function home(?array $data): void
    {
        $channels = (new Channel())->find();

        $pager = new Pager(url("/admin/faq/home/"));
        $pager->pager($channels->count(), 5, (!empty($data["page"]) ? $data["page"] : 1));

        $head = $this->seo->render(
            CONF_SITE_NAME . " | FAQs",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/admin/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/faqs/home", [
            "app" => "faq/home",
            "head" => $head,
            "channels" => $channels->order("channel")->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * @param array|null $data
     */
    public function channel(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $channelCreate = new Channel();
            $channelCreate->channel = $data["channel"];
            $channelCreate->description = $data["description"];

            if (!$channelCreate->save()) {
                $json["message"] = $channelCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Canal cadastrado com sucesso")->render();
            echo json_encode(["redirect" => url("/admin/faq/channel/{$channelCreate->id}")]);
            
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $channelEdit = (new Channel())->findById($data["channel_id"]);

            if (!$channelEdit) {
                $this->message->error("Você tentou editar um canal que nao existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/faq/home")]);
                return;
            }

            $channelEdit->channel = $data["channel"];
            $channelEdit->description = $data["description"];

            if (!$channelEdit->save()) {
                $json["message"] = $channelEdit->message()->render();
                echo json_encode($json);
                return;
            }
            
            $json["message"] = $this->message->success("Canal atualizado com sucesso...")->render();
            echo json_encode($json);

            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $channelDelete = (new Channel())->findById($data["channel_id"]);

            if (!$channelDelete) {
                $this->message->error("Você tentou remover um canal que nao existe ou já foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/faq/home")]);
                return;
            }

            $channelDelete->destroy();
            $this->message->success("Canal escluido com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/faq/home")]);
            return;
        }

        $channelEdit = null;
        if (!empty($data["channel_id"])) {
            $channelId = filter_var($data["channel_id"], FILTER_VALIDATE_INT);
            $channelEdit = (new Channel())->findById($channelId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($channelEdit ? "FAQ: {$channelEdit->channel}" : "FAQ: Novo Canal"),
            CONF_SITE_DESC,
            url("/admin"),
            theme("/admin/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/faqs/channel", [
            "app" => "faq/home",
            "head" => $head,
            "channel" => $channelEdit
        ]);
    }

    /**
     * @param array|null $data
     */
    public function question(?array $data): void
    {
        $head = $this->seo->render(
            CONF_SITE_NAME . " | FAQ: Pergunta",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/admin/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/faqs/question", [
            "app" => "faq/home",
            "head" => $head,
            "channel" => (object)[
                "id" => 10
            ],
            "question" => ""
        ]);
    }
}

