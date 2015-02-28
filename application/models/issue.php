<?php

class Issue extends CI_Model {

  /**
   * issue unique identifier
   * @var int
   */
  private $id;

  /**
   * publication unifying record
   * @var int
   */
  private $publication_id;

  /**
   * publisher assigned issue number
   * @var int
   */
  private $number;

  /**
   * date the issue published
   * @var string
   */
  private $date_publication;

  /**
   * path to the file containing the cover image
   * @var string
   */
  private $cover;
}
