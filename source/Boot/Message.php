<?php

namespace Source\Boot;

use Source\Core\Session;

/**
 * Class Message com Sweet Alert
 * @package Source\Boot
 * @author Adam Almeida <adam.designjuridico@gmail.com>
 */
class Message
{
    /** @var string */
    private $text;

    /** @var string */
    private $title;


    /** @var string */
    private $type;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $message
     * @param string $title
     * @param string $type
     * @return $this
     */
    public function renderMessage(string $message, string $title, string $type): Message
    {
        $this->title = $this->filter($title);
        $this->type = $this->filter($type);
        $this->text = $this->filter($message);
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return "<script>swal({
              title: '{$this->getTitle()}',
              text: '{$this->getText()}',
              icon: '{$this->getType()}',
              button: 'Voltar',
        });</script>";
    }

    /**
     * Set flash Session Key
     */
    public function flash(): void
    {
        (new Session())->set("flash", $this);
    }

    /**
     * @param string $message
     * @return string
     */
    private function filter(string $message): string
    {
        return filter_var($message, FILTER_SANITIZE_STRIPPED);
    }
}