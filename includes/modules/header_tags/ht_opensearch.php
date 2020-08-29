<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @licence MIT - Portion of osCommerce 2.4
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\HTTP;

  class ht_opensearch
  {
    public $code;
    public $group;
    public string $title;
    public string $description;
    public ?int $sort_order = 0;
    public bool $enabled = false;

    public function __construct()
    {
      $this->code = get_class($this);
      $this->group = basename(__DIR__);
      $this->title = CLICSHOPPING::getDef('module_header_tags_opensearch_title');
      $this->description = CLICSHOPPING::getDef('module_header_tags_opensearch_description');

      if (defined('MODULE_HEADER_TAGS_OPENSEARCH_STATUS')) {
        $this->sort_order = MODULE_HEADER_TAGS_OPENSEARCH_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_OPENSEARCH_STATUS == 'True');
      }
    }

    public function execute()
    {

      $CLICSHOPPING_Template = Registry::get('Template');

      $CLICSHOPPING_Template->addBlock('<link rel="search" type="application/opensearchdescription+xml" href="' . CLICSHOPPING::link(null, 'Search&OpenSearch') . '" title="' . HTML::output(STORE_NAME) . '">', $this->group);
    }

    public function isEnabled()
    {
      return $this->enabled;
    }

    public function check()
    {
      return defined('MODULE_HEADER_TAGS_OPENSEARCH_STATUS');
    }

    public function install()
    {
      $CLICSHOPPING_Db = Registry::get('Db');


      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Do you want to install this module ?',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_STATUS',
          'configuration_value' => 'True',
          'configuration_description' => 'Do you want to install this module ?',
          'configuration_group_id' => '6',
          'sort_order' => '1',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'True\', \'False\'))',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Veuillez insérer une description courte pour le moteur de recherche',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_SHORT_NAME',
          'configuration_value' => STORE_NAME,
          'configuration_description' => 'Nom court pour décrire votre site au moteur de recherche (16 caract&egrave;res max)',
          'configuration_group_id' => '6',
          'sort_order' => '2',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Description',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_DESCRIPTION',
          'configuration_value' => STORE_NAME,
          'configuration_description' => 'Description de votre site pour les moteurs de recherche (250 caract&egrave;res max)',
          'configuration_group_id' => '6',
          'sort_order' => '3',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Veuillez indiquer votre email de contact',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_CONTACT',
          'configuration_value' => STORE_OWNER_EMAIL_ADDRESS,
          'configuration_description' => 'Veuillez insérer votre adresse e-mail pour la communication avec le moteur de recherche. (optionel)',
          'configuration_group_id' => '6',
          'sort_order' => '4',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Veuillez insérer vos tags - Mots clefs',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_TAGS',
          'configuration_value' => '',
          'configuration_description' => 'Mots clefs pour vous permettre d\'etre identié et de categoriser le contenu de la recherche, separaré par un espace vide. (optionel)',
          'configuration_group_id' => '6',
          'sort_order' => '5',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Souhaitez-vous insérer un Copyright ?',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ATTRIBUTION',
          'configuration_value' => STORE_NAME,
          'configuration_description' => 'Copyright pour le contenu du moteur de recherche. (optionel)',
          'configuration_group_id' => '6',
          'sort_order' => '6',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Avez-vous un contenu s\'adressant uniquement pour le milieu adulte ?',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ADULT_CONTENT',
          'configuration_value' => 'False',
          'configuration_description' => 'Contenu uniquement adressé pour les adultes',
          'configuration_group_id' => '6',
          'sort_order' => '7',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'True\', \'False\'))',
          'date_added' => 'now()'
        ]
      );


      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Veuillez insérer l\'adresse http du Favicon avec la dimension 16x16',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ICON',
          'configuration_value' => '',
          'configuration_description' => 'La dimension doit etre in icon de 16x16 pixels(doit etre au format .ico, ex http://server/boutique/sources/images/icons/favicon.ico). (optionel)',
          'configuration_group_id' => '7',
          'sort_order' => '6',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Veuillez insérer l\'adresse http du Favicon avec la dimension 64x64',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SITE_IMAGE',
          'configuration_value' => HTTP::typeUrlDomain() . '/boutique/sources/images/icons/favicon.png',
          'configuration_description' => 'La dimension doit etre 64x64 pixels (doit etre au format .png, ex: http://server/boutique/sources/images/icons/favicon.png). (optionel)',
          'configuration_group_id' => '6',
          'sort_order' => '8',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );

      $CLICSHOPPING_Db->save('configuration', [
          'configuration_title' => 'Sort Order',
          'configuration_key' => 'MODULE_HEADER_TAGS_OPENSEARCH_SORT_ORDER',
          'configuration_value' => '150',
          'configuration_description' => 'Sort order. Lowest is displayed in first',
          'configuration_group_id' => '6',
          'sort_order' => '130',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );


      return $CLICSHOPPING_Db->save('configuration', ['configuration_value' => '1'],
        ['configuration_key' => 'WEBSITE_MODULE_INSTALLED']
      );
    }

    public function remove()
    {
      return Registry::get('Db')->exec('delete from :table_configuration where configuration_key in ("' . implode('", "', $this->keys()) . '")');
    }

    public function keys()
    {
      return array('MODULE_HEADER_TAGS_OPENSEARCH_STATUS',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_SHORT_NAME',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_DESCRIPTION',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_CONTACT',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_TAGS',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ATTRIBUTION',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ADULT_CONTENT',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_ICON',
        'MODULE_HEADER_TAGS_OPENSEARCH_SITE_IMAGE',
        'MODULE_HEADER_TAGS_OPENSEARCH_SORT_ORDER'
      );
    }
  }
