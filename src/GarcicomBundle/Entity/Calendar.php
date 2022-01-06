<?php

namespace GarcicomBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calendar
 *
 * @ORM\Table(name="calendar")
 * @ORM\Entity(repositoryClass="GarcicomBundle\Repository\CalendarRepository")
 */
class Calendar
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start", type="datetime")
     */
    private $start;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="datetime")
     */
    private $end;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="all_day", type="string", length=255)
     */
    private $allDay;

    /**
     * @var string
     *
     * @ORM\Column(name="backgroundcolor", type="string", length=7)
     */
    private $backgroundcolor;

    /**
     * @var string
     *
     * @ORM\Column(name="border_color", type="string", length=7)
     */
    private $borderColor;

    /**
     * @var string
     *
     * @ORM\Column(name="textcolor", type="string", length=7)
     */
    private $textcolor;


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
     * @return Calendar
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
     * Set start
     *
     * @param \DateTime $start
     *
     * @return Calendar
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param \DateTime $end
     *
     * @return Calendar
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Calendar
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set allDay
     *
     * @param string $allDay
     *
     * @return Calendar
     */
    public function setAllDay($allDay)
    {
        $this->allDay = $allDay;

        return $this;
    }

    /**
     * Get allDay
     *
     * @return string
     */
    public function getAllDay()
    {
        return $this->allDay;
    }

    /**
     * Set backgroundcolor
     *
     * @param string $backgroundcolor
     *
     * @return Calendar
     */
    public function setBackgroundcolor($backgroundcolor)
    {
        $this->backgroundcolor = $backgroundcolor;

        return $this;
    }

    /**
     * Get backgroundcolor
     *
     * @return string
     */
    public function getBackgroundcolor()
    {
        return $this->backgroundcolor;
    }

    /**
     * Set borderColor
     *
     * @param string $borderColor
     *
     * @return Calendar
     */
    public function setBorderColor($borderColor)
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    /**
     * Get borderColor
     *
     * @return string
     */
    public function getBorderColor()
    {
        return $this->borderColor;
    }

    /**
     * Set textcolor
     *
     * @param string $textcolor
     *
     * @return Calendar
     */
    public function setTextcolor($textcolor)
    {
        $this->textcolor = $textcolor;

        return $this;
    }

    /**
     * Get textcolor
     *
     * @return string
     */
    public function getTextcolor()
    {
        return $this->textcolor;
    }
}

