<?php
namespace Source\App\Admin;

use Source\Models\Faq\Channel;
use Source\Models\Faq\Question;
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
            $channelUpdate = (new Channel())->findById($data["channel_id"]);

            if (!$channelUpdate) {
                $this->message->error("Você tentou editar um canal que nao existe ou foi removido")->flash();
                echo json_encode(["redirect" => url("/admin/faq/home")]);
                return;
            }

            $channelUpdate->channel = $data["channel"];
            $channelUpdate->description = $data["description"];

            if (!$channelUpdate->save()) {
                $json["message"] = $channelUpdate->message()->render();
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
            $this->message->success("Canal excluido com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/faq/home")]);
            return;
        }

        $channelUpdate = null;
        if (!empty($data["channel_id"])) {
            $channelId = filter_var($data["channel_id"], FILTER_VALIDATE_INT);
            $channelUpdate = (new Channel())->findById($channelId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | " . ($channelUpdate ? "FAQ: {$channelUpdate->channel}" : "FAQ: Novo Canal"),
            CONF_SITE_DESC,
            url("/admin"),
            theme("/admin/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/faqs/channel", [
            "app" => "faq/home",
            "head" => $head,
            "channel" => $channelUpdate
        ]);
    }

    /**
     * @param array|null $data
     */
    public function question(?array $data): void
    {
        //create
        if (!empty($data["action"]) && $data["action"] == "create") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            $questionCreate = new Question();
            $questionCreate->channel_id = $data["channel_id"];
            $questionCreate->question = $data["question"];
            $questionCreate->response = $data["response"];
            $questionCreate->order_by = $data["order_by"];

            if (!$questionCreate->save()) {
                $json["message"] = $questionCreate->message()->render();
                echo json_encode($json);
                return;
            }

            $this->message->success("Pergunta cadastrada com sucesso")->render();
            echo json_encode(["redirect" => url("/admin/faq/question/{$questionCreate->channel_id}/{$questionCreate->id}")]);
            
            return;
        }

        //update
        if (!empty($data["action"]) && $data["action"] == "update") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $questionUpdate = (new Question())->findById($data["question_id"]);

            if (!$questionUpdate) {
                $this->message->error("Você tentou editar uma pergunta que não existe ou foi removida")->flash();
                echo json_encode(["redirect" => url("/admin/faq/home")]);
                return;
            }

            $questionUpdate->channel_id = $data["channel_id"];
            $questionUpdate->question = $data["question"];
            $questionUpdate->response = $data["response"];
            $questionUpdate->order_by = $data["order_by"];

            if (!$questionUpdate->save()) {
                $json["message"] = $questionUpdate->message()->render();
                echo json_encode($json);
                return;
            }
            
            $json["message"] = $this->message->success("Pergunta atualizada com sucesso...")->render();
            echo json_encode($json);
            return;
        }

        //delete
        if (!empty($data["action"]) && $data["action"] == "delete") {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            $questionDelete = (new Question())->findById($data["question_id"]);

            if (!$questionDelete) {
                $this->message->error("Você tentou remover uma pergunta que nao existe")->flash();
                echo json_encode(["redirect" => url("/admin/faq/home")]);
                return;
            }

            $questionDelete->destroy();
            $this->message->success("Pergunta excluida com sucesso...")->flash();

            echo json_encode(["redirect" => url("/admin/faq/home")]);
            return;
        }

        $channel = (new Channel())->findById($data["channel_id"]);
        $question = null;

        if (!$channel) {
            $this->message->warning("Você tentou gerenciar perguntas de um canal que não existe")->flash();
            redirect("/admin/faq/home");
        }

        if (!empty($data["question_id"])) {
            $questionId = filter_var($data["question_id"], FILTER_VALIDATE_INT);
            $question = (new Question())->findById($questionId);
        }

        $head = $this->seo->render(
            CONF_SITE_NAME . " | FAQ: Pergunta em {$channel->channel}",
            CONF_SITE_DESC,
            url("/admin"),
            theme("/admin/assets/images/image.jpg", CONF_VIEW_ADMIN),
            false
        );

        echo $this->view->render("widgets/faqs/question", [
            "app" => "faq/home",
            "head" => $head,
            "channel" => $channel,
            "question" => $question
        ]);
    }
}

