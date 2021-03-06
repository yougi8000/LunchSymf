<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ArticleCategory", inversedBy="articles")
     */
    private $category;

        /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article")
     */
    private $comments;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLiked;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="post")
     */
    private $likes;

    public function __construct()
    {
        $this->likes = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="post")
     */
        

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getCategory(): ?ArticleCategory
    {
        return $this->category;
    }

    public function setCategory(?ArticleCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if(!$this->comments->contains($comment)){
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
            
        }

        return $this;
    }
  

  public function getIsLiked(): ?bool
  {
      return $this->isLiked;
  }

  public function setIsLiked(?bool $isLiked): self
  {
      $this->isLiked = $isLiked;

      return $this;
  }

  /**
   * @return Collection|PostLike[]
   */
  public function getLikes(): Collection
  {
      return $this->likes;
  }

  public function addLike(PostLike $like): self
  {
      if (!$this->likes->contains($like)) {
          $this->likes[] = $like;
          $like->setPost($this);
      }

      return $this;
  }

  public function removeLike(PostLike $like): self
  {
      if ($this->likes->contains($like)) {
          $this->likes->removeElement($like);
          // set the owning side to null (unless already changed)
          if ($like->getPost() === $this) {
              $like->setPost(null);
          }
      }

      return $this;
  }
    
}
