<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace AHT\Blog\Api\Data;

interface BlogInterface
{

    const AUTHOR = 'author';
    const TAG = 'tag';
    const BLOG_ID = 'blog_id';
    const CONTENT = 'content';
    const THUMBNAIL = 'thumbnail';
    const DESCRIPTION = 'description';
    const TITLE = 'title';
    const STATUS = 'status';
    const PUBLISH_DATE = 'publish_date';

    /**
     * Get blog_id
     * @return string|null
     */
    public function getBlogId();

    /**
     * Set blog_id
     * @param string $blogId
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setBlogId($blogId);

    /**
     * Get title
     * @return string|null
     */
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setTitle($title);

    /**
     * Get author
     * @return string|null
     */
    public function getAuthor();

    /**
     * Set author
     * @param string $author
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setAuthor($author);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setStatus($status);

    /**
     * Get tag
     * @return string|null
     */
    public function getTag();

    /**
     * Set tag
     * @param string $tag
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setTag($tag);

    /**
     * Get thumbnail
     * @return string|null
     */
    public function getThumbnail();

    /**
     * Set thumbnail
     * @param string $thumbnail
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setThumbnail($thumbnail);

    /**
     * Get description
     * @return string|null
     */
    public function getDescription();

    /**
     * Set description
     * @param string $description
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setDescription($description);

    /**
     * Get content
     * @return string|null
     */
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setContent($content);

    /**
     * Get publish_date
     * @return string|null
     */
    public function getPublishDate();

    /**
     * Set publish_date
     * @param string $publishDate
     * @return \AHT\Blog\Blog\Api\Data\BlogInterface
     */
    public function setPublishDate($publishDate);
}

