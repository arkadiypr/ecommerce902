<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeedbackRequestRepository")
 */
class FeedbackRequest
{

    const TOPIC_PAYMENT_DELIVERY = 1;
    const TOPIC_COOPERATION = 2;
    const TOPIC_COMMON = 3;

    public static $topics = [
        self::TOPIC_PAYMENT_DELIVERY => 'Оплата и доставка',
        self::TOPIC_COOPERATION => 'Сотрудничество',
        self::TOPIC_COMMON => 'Общие вопросы',
    ];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="3")
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(checkHost=true, checkMX=true)
     * @Assert\NotBlank()
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $topic;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min="10", max="2000")
     * @Assert\NotBlank()
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTopic(): ?int
    {
        return $this->topic;
    }

    public function setTopic(int $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
