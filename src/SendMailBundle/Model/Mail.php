<?php
namespace SendMailBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

class Mail
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $subject;

    /**
     * @var string
     * @Assert\NotBlank
     */
    private $content;

    /**
     * @var ArrayCollection
     * @Assert\All({
     *     @Assert\File(
     *          maxSize = "1024k",
     *     )
     * })
     */
    private $files;

    public function __construct()
    {
        $this->files = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Mail
     */
    public function setEmail(string $email): Mail
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     * @return Mail
     */
    public function setSubject(string $subject): Mail
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Mail
     */
    public function setContent($content): Mail
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getFiles() : ArrayCollection
    {
        return $this->files;
    }

    /**
     * @param array $files
     * @return Mail
     */
    public function setFiles(array $files): Mail
    {
        $this->files = new ArrayCollection($files);
        return $this;
    }

    public function addFile(File $file)
    {
        $this->files[] = $file;
    }
}