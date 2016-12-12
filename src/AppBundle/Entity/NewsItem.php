<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * NewsItem
 *
 * @ORM\Table(name="news_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NewsItemRepository")
 */
class NewsItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=127)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="url_name", type="string", length=63, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $urlName;

    
    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="string", length=1023)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $preview;
    
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=65535)
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $content;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return NewsItem
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set urlName
     *
     * @param string $urlName
     *
     * @return NewsItem
     */
    public function setUrlName($urlName)
    {
        $this->urlName = $urlName;

        return $this;
    }

    /**
     * Get urlName
     *
     * @return string
     */
    public function getUrlName()
    {
        return $this->urlName;
    }

    /**
     * Set preview
     *
     * @param string $preview
     *
     * @return NewsItem
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }
    
    /**
     * Set content
     *
     * @param string $content
     *
     * @return NewsItem
     */
    public function setContent($content)
    {
        $this->content = strip_tags($content, '<h2><h3><p><br><b><i><u><ul><ol><li>');

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}

