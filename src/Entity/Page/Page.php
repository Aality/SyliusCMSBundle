<?php

namespace Aality\SyliusCMSBundle\Entity\Page;

use ApiPlatform\Metadata\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Aality\SyliusCMSBundle\Repository\PageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ChannelInterface;

#[ORM\Entity(repositoryClass: PageRepository::class)]
#[ApiResource]
class Page implements PageInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
        message: 'Le slug ne peut contenir que des lettres minuscules, des chiffres et des tirets (pas de tiret en début ou fin, ni consécutifs).'
    )]
    #[Assert\NotBlank]
    private ?string $slug = null;

    #[ORM\ManyToOne(targetEntity: ChannelInterface::class)]
    #[ORM\JoinColumn(name: 'channel_id', referencedColumnName: 'id', nullable: true)]
    private ?ChannelInterface $channel = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $metaDescription = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $content = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }


    public function getChannel(): ?ChannelInterface
    {
        return $this->channel;
    }

    public function setChannel(?ChannelInterface $channel): void
    {
        $this->channel = $channel;
    }

    public function getPublicUrl(): ?string
    {
        $slug = $this->getSlug();
        $channel = $this->getChannel();

        if (!$slug) {
            return null;
        }

        if (!$channel && method_exists($this, 'getChannels')) {
            $channels = $this->getChannels();
            if ($channels instanceof \Traversable || is_array($channels)) {
                foreach ($channels as $c) {
                    $channel = $c;
                    break;
                }
            }
        }

        if (!$channel) {
            return null;
        }

        return $slug . '|' . $channel->getHostname();
    }
}
