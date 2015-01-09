<?php
/**
 * Catalog entity setup
 *
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Catalog\Model\Resource;

class Setup extends \Magento\Eav\Model\Entity\Setup
{
    /**
     * Category model factory
     *
     * @var \Magento\Catalog\Model\CategoryFactory
     */
    protected $_categoryFactory;

    /**
     * Attribute resource model factory
     *
     * @var \Magento\Catalog\Model\Resource\Eav\AttributeFactory
     */
    protected $_eavAttributeResourceFactory;

    /**
     * @param \Magento\Eav\Model\Entity\Setup\Context $context
     * @param string $resourceName
     * @param \Magento\Framework\App\CacheInterface $cache
     * @param \Magento\Eav\Model\Resource\Entity\Attribute\Group\CollectionFactory $attrGroupCollectionFactory
     * @param \Magento\Catalog\Model\CategoryFactory $categoryFactory
     * @param Eav\AttributeFactory $eavAttributeResourceFactory
     * @param string $moduleName
     * @param string $connectionName
     */
    public function __construct(
        \Magento\Eav\Model\Entity\Setup\Context $context,
        $resourceName,
        \Magento\Framework\App\CacheInterface $cache,
        \Magento\Eav\Model\Resource\Entity\Attribute\Group\CollectionFactory $attrGroupCollectionFactory,
        \Magento\Catalog\Model\CategoryFactory $categoryFactory,
        \Magento\Catalog\Model\Resource\Eav\AttributeFactory $eavAttributeResourceFactory,
        $moduleName = 'Magento_Catalog',
        $connectionName = \Magento\Framework\Module\Updater\SetupInterface::DEFAULT_SETUP_CONNECTION
    ) {
        $this->_categoryFactory = $categoryFactory;
        $this->_eavAttributeResourceFactory = $eavAttributeResourceFactory;
        parent::__construct(
            $context,
            $resourceName,
            $cache,
            $attrGroupCollectionFactory,
            $moduleName,
            $connectionName
        );
    }

    /**
     * Creates category model
     *
     * @param array $data
     * @return \Magento\Catalog\Model\Category
     */
    public function createCategory($data = [])
    {
        return $this->_categoryFactory->create($data);
    }

    /**
     * Creates eav attribute resource model
     *
     * @param array $data
     * @return \Magento\Catalog\Model\Resource\Eav\Attribute
     */
    public function createEavAttributeResource($data = [])
    {
        return $this->_eavAttributeResourceFactory->create($data);
    }

    /**
     * Default entites and attributes
     *
     * @return array
     */
    public function getDefaultEntities()
    {
        return [
            'catalog_category' => [
                'entity_model' => 'Magento\Catalog\Model\Resource\Category',
                'attribute_model' => 'Magento\Catalog\Model\Resource\Eav\Attribute',
                'table' => 'catalog_category_entity',
                'additional_attribute_table' => 'catalog_eav_attribute',
                'entity_attribute_collection' => 'Magento\Catalog\Model\Resource\Category\Attribute\Collection',
                'default_group' => 'General Information',
                'attributes' => [
                    'name' => [
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'sort_order' => 1,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'is_active' => [
                        'type' => 'int',
                        'label' => 'Is Active',
                        'input' => 'select',
                        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                        'sort_order' => 2,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'description' => [
                        'type' => 'text',
                        'label' => 'Description',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 4,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'wysiwyg_enabled' => true,
                        'is_html_allowed_on_front' => true,
                        'group' => 'General Information',
                    ],
                    'image' => [
                        'type' => 'varchar',
                        'label' => 'Image',
                        'input' => 'image',
                        'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Image',
                        'required' => false,
                        'sort_order' => 5,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'meta_title' => [
                        'type' => 'varchar',
                        'label' => 'Page Title',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 6,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'meta_keywords' => [
                        'type' => 'text',
                        'label' => 'Meta Keywords',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 7,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'meta_description' => [
                        'type' => 'text',
                        'label' => 'Meta Description',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 8,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'display_mode' => [
                        'type' => 'varchar',
                        'label' => 'Display Mode',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Mode',
                        'required' => false,
                        'sort_order' => 10,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Display Settings',
                    ],
                    'landing_page' => [
                        'type' => 'int',
                        'label' => 'CMS Block',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Page',
                        'required' => false,
                        'sort_order' => 20,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Display Settings',
                    ],
                    'is_anchor' => [
                        'type' => 'int',
                        'label' => 'Is Anchor',
                        'input' => 'select',
                        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                        'required' => false,
                        'sort_order' => 30,
                        'group' => 'Display Settings',
                    ],
                    'path' => [
                        'type' => 'static',
                        'label' => 'Path',
                        'required' => false,
                        'sort_order' => 12,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'position' => [
                        'type' => 'static',
                        'label' => 'Position',
                        'required' => false,
                        'sort_order' => 13,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'all_children' => [
                        'type' => 'text',
                        'required' => false,
                        'sort_order' => 14,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'path_in_store' => [
                        'type' => 'text',
                        'required' => false,
                        'sort_order' => 15,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'children' => [
                        'type' => 'text',
                        'required' => false,
                        'sort_order' => 16,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'custom_design' => [
                        'type' => 'varchar',
                        'label' => 'Custom Design',
                        'input' => 'select',
                        'source' => 'Magento\Core\Model\Theme\Source\Theme',
                        'required' => false,
                        'sort_order' => 10,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'custom_design_from' => [
                        'type' => 'datetime',
                        'label' => 'Active From',
                        'input' => 'date',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
                        'required' => false,
                        'sort_order' => 30,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'custom_design_to' => [
                        'type' => 'datetime',
                        'label' => 'Active To',
                        'input' => 'date',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
                        'required' => false,
                        'sort_order' => 40,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'page_layout' => [
                        'type' => 'varchar',
                        'label' => 'Page Layout',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Layout',
                        'required' => false,
                        'sort_order' => 50,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'custom_layout_update' => [
                        'type' => 'text',
                        'label' => 'Custom Layout Update',
                        'input' => 'textarea',
                        'backend' => 'Magento\Catalog\Model\Attribute\Backend\Customlayoutupdate',
                        'required' => false,
                        'sort_order' => 60,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'level' => [
                        'type' => 'static',
                        'label' => 'Level',
                        'required' => false,
                        'sort_order' => 24,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'children_count' => [
                        'type' => 'static',
                        'label' => 'Children Count',
                        'required' => false,
                        'sort_order' => 25,
                        'visible' => false,
                        'group' => 'General Information',
                    ],
                    'available_sort_by' => [
                        'type' => 'text',
                        'label' => 'Available Product Listing Sort By',
                        'input' => 'multiselect',
                        'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Sortby',
                        'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Sortby',
                        'sort_order' => 40,
                        'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Category\Helper\Sortby\Available',
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Display Settings',
                    ],
                    'default_sort_by' => [
                        'type' => 'varchar',
                        'label' => 'Default Product Listing Sort By',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Category\Attribute\Source\Sortby',
                        'backend' => 'Magento\Catalog\Model\Category\Attribute\Backend\Sortby',
                        'sort_order' => 50,
                        'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Category\Helper\Sortby\DefaultSortby',
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Display Settings',
                    ],
                    'include_in_menu' => [
                        'type' => 'int',
                        'label' => 'Include in Navigation Menu',
                        'input' => 'select',
                        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                        'default' => '1',
                        'sort_order' => 10,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'General Information',
                    ],
                    'custom_use_parent_settings' => [
                        'type' => 'int',
                        'label' => 'Use Parent Category Settings',
                        'input' => 'select',
                        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                        'required' => false,
                        'sort_order' => 5,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'custom_apply_to_products' => [
                        'type' => 'int',
                        'label' => 'Apply To Products',
                        'input' => 'select',
                        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                        'required' => false,
                        'sort_order' => 6,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Custom Design',
                    ],
                    'filter_price_range' => [
                        'type' => 'decimal',
                        'label' => 'Layered Navigation Price Step',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 51,
                        'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Category\Helper\Pricestep',
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Display Settings',
                    ],
                ],
            ],
            'catalog_product' => [
                'entity_model' => 'Magento\Catalog\Model\Resource\Product',
                'attribute_model' => 'Magento\Catalog\Model\Resource\Eav\Attribute',
                'table' => 'catalog_product_entity',
                'additional_attribute_table' => 'catalog_eav_attribute',
                'entity_attribute_collection' => 'Magento\Catalog\Model\Resource\Product\Attribute\Collection',
                'attributes' => [
                    'name' => [
                        'type' => 'varchar',
                        'label' => 'Name',
                        'input' => 'text',
                        'frontend_class' => 'validate-length maximum-length-255',
                        'sort_order' => 1,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'searchable' => true,
                        'visible_in_advanced_search' => true,
                        'used_in_product_listing' => true,
                        'used_for_sort_by' => true,
                    ],
                    'sku' => [
                        'type' => 'static',
                        'label' => 'SKU',
                        'input' => 'text',
                        'frontend_class' => 'validate-length maximum-length-64',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Sku',
                        'unique' => true,
                        'sort_order' => 2,
                        'searchable' => true,
                        'comparable' => true,
                        'visible_in_advanced_search' => true,
                    ],
                    'description' => [
                        'type' => 'text',
                        'label' => 'Description',
                        'input' => 'textarea',
                        'sort_order' => 3,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'searchable' => true,
                        'comparable' => true,
                        'wysiwyg_enabled' => true,
                        'is_html_allowed_on_front' => true,
                        'visible_in_advanced_search' => true,
                    ],
                    'short_description' => [
                        'type' => 'text',
                        'label' => 'Short Description',
                        'input' => 'textarea',
                        'sort_order' => 4,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'searchable' => true,
                        'comparable' => true,
                        'wysiwyg_enabled' => true,
                        'is_html_allowed_on_front' => true,
                        'visible_in_advanced_search' => true,
                        'used_in_product_listing' => true,
                    ],
                    'price' => [
                        'type' => 'decimal',
                        'label' => 'Price',
                        'input' => 'price',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Price',
                        'sort_order' => 1,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'searchable' => true,
                        'filterable' => true,
                        'visible_in_advanced_search' => true,
                        'used_in_product_listing' => true,
                        'used_for_sort_by' => true,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'special_price' => [
                        'type' => 'decimal',
                        'label' => 'Special Price',
                        'input' => 'price',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Price',
                        'required' => false,
                        'sort_order' => 3,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'used_in_product_listing' => true,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'special_from_date' => [
                        'type' => 'datetime',
                        'label' => 'Special Price From Date',
                        'input' => 'date',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Startdate',
                        'required' => false,
                        'sort_order' => 4,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'used_in_product_listing' => true,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'special_to_date' => [
                        'type' => 'datetime',
                        'label' => 'Special Price To Date',
                        'input' => 'date',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
                        'required' => false,
                        'sort_order' => 5,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'used_in_product_listing' => true,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'cost' => [
                        'type' => 'decimal',
                        'label' => 'Cost',
                        'input' => 'price',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Price',
                        'required' => false,
                        'user_defined' => true,
                        'sort_order' => 6,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'weight' => [
                        'type' => 'decimal',
                        'label' => 'Weight',
                        'input' => 'weight',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Weight',
                        'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Weight',
                        'sort_order' => 5,
                        'apply_to' => 'simple,virtual',
                    ],
                    'manufacturer' => [
                        'type' => 'int',
                        'label' => 'Manufacturer',
                        'input' => 'select',
                        'required' => false,
                        'user_defined' => true,
                        'searchable' => true,
                        'filterable' => true,
                        'comparable' => true,
                        'visible_in_advanced_search' => true,
                        'apply_to' => \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE,
                    ],
                    'meta_title' => [
                        'type' => 'varchar',
                        'label' => 'Meta Title',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 20,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Meta Information',
                    ],
                    'meta_keyword' => [
                        'type' => 'text',
                        'label' => 'Meta Keywords',
                        'input' => 'textarea',
                        'required' => false,
                        'sort_order' => 30,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Meta Information',
                    ],
                    'meta_description' => [
                        'type' => 'varchar',
                        'label' => 'Meta Description',
                        'input' => 'textarea',
                        'required' => false,
                        'note' => 'Maximum 255 chars',
                        'class' => 'validate-length maximum-length-255',
                        'sort_order' => 40,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Meta Information',
                    ],
                    'image' => [
                        'type' => 'varchar',
                        'label' => 'Base Image',
                        'input' => 'media_image',
                        'frontend' => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
                        'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\BaseImage',
                        'required' => false,
                        'sort_order' => 0,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'used_in_product_listing' => true,
                        'group' => 'General',
                    ],
                    'small_image' => [
                        'type' => 'varchar',
                        'label' => 'Small Image',
                        'input' => 'media_image',
                        'frontend' => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
                        'required' => false,
                        'sort_order' => 2,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'used_in_product_listing' => true,
                        'group' => 'Images',
                    ],
                    'thumbnail' => [
                        'type' => 'varchar',
                        'label' => 'Thumbnail',
                        'input' => 'media_image',
                        'frontend' => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
                        'required' => false,
                        'sort_order' => 3,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'used_in_product_listing' => true,
                        'group' => 'Images',
                    ],
                    'media_gallery' => [
                        'type' => 'varchar',
                        'label' => 'Media Gallery',
                        'input' => 'gallery',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Media',
                        'required' => false,
                        'sort_order' => 4,
                        'group' => 'Images',
                    ],
                    'old_id' => ['type' => 'int', 'required' => false, 'sort_order' => 6, 'visible' => false],
                    'group_price' => [
                        'type' => 'decimal',
                        'label' => 'Group Price',
                        'input' => 'text',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\GroupPrice',
                        'required' => false,
                        'sort_order' => 2,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'tier_price' => [
                        'type' => 'decimal',
                        'label' => 'Tier Price',
                        'input' => 'text',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Tierprice',
                        'required' => false,
                        'sort_order' => 7,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'color' => [
                        'type' => 'int',
                        'label' => 'Color',
                        'input' => 'select',
                        'required' => false,
                        'user_defined' => true,
                        'searchable' => true,
                        'filterable' => true,
                        'comparable' => true,
                        'visible_in_advanced_search' => true,
                        'apply_to' => \Magento\Catalog\Model\Product\Type::TYPE_SIMPLE,
                    ],
                    'news_from_date' => [
                        'type' => 'datetime',
                        'label' => 'Set Product as New from Date',
                        'input' => 'date',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Startdate',
                        'required' => false,
                        'sort_order' => 7,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'used_in_product_listing' => true,
                    ],
                    'news_to_date' => [
                        'type' => 'datetime',
                        'label' => 'Set Product as New to Date',
                        'input' => 'date',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
                        'required' => false,
                        'sort_order' => 8,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'used_in_product_listing' => true,
                    ],
                    'gallery' => [
                        'type' => 'varchar',
                        'label' => 'Image Gallery',
                        'input' => 'gallery',
                        'required' => false,
                        'sort_order' => 5,
                        'group' => 'Images',
                    ],
                    'status' => [
                        'type' => 'int',
                        'label' => 'Status',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Product\Attribute\Source\Status',
                        'sort_order' => 9,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'searchable' => true,
                        'used_in_product_listing' => true,
                    ],
                    'minimal_price' => [
                        'type' => 'decimal',
                        'label' => 'Minimal Price',
                        'input' => 'price',
                        'required' => false,
                        'sort_order' => 8,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'visible' => false,
                        'apply_to' => 'simple,virtual',
                        'group' => 'Prices',
                    ],
                    'visibility' => [
                        'type' => 'int',
                        'label' => 'Visibility',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Product\Visibility',
                        'default' => '4',
                        'sort_order' => 12,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                    ],
                    'custom_design' => [
                        'type' => 'varchar',
                        'label' => 'Custom Design',
                        'input' => 'select',
                        'source' => 'Magento\Core\Model\Theme\Source\Theme',
                        'required' => false,
                        'sort_order' => 1,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Design',
                    ],
                    'custom_design_from' => [
                        'type' => 'datetime',
                        'label' => 'Active From',
                        'input' => 'date',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Startdate',
                        'required' => false,
                        'sort_order' => 2,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Design',
                    ],
                    'custom_design_to' => [
                        'type' => 'datetime',
                        'label' => 'Active To',
                        'input' => 'date',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Datetime',
                        'required' => false,
                        'sort_order' => 3,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Design',
                    ],
                    'custom_layout_update' => [
                        'type' => 'text',
                        'label' => 'Custom Layout Update',
                        'input' => 'textarea',
                        'backend' => 'Magento\Catalog\Model\Attribute\Backend\Customlayoutupdate',
                        'required' => false,
                        'sort_order' => 4,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Design',
                    ],
                    'page_layout' => [
                        'type' => 'varchar',
                        'label' => 'Page Layout',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Product\Attribute\Source\Layout',
                        'required' => false,
                        'sort_order' => 5,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Design',
                    ],
                    'category_ids' => [
                        'type' => 'static',
                        'label' => 'Categories',
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_GLOBAL,
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Category',
                        'input_renderer' => 'Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category',
                        'required' => false,
                        'sort_order' => 9,
                        'visible' => true,
                        'group' => 'General',
                    ],
                    'options_container' => [
                        'type' => 'varchar',
                        'label' => 'Display Product Options In',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Entity\Product\Attribute\Design\Options\Container',
                        'required' => false,
                        'default' => 'container2',
                        'sort_order' => 6,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'group' => 'Design',
                    ],
                    'required_options' => [
                        'type' => 'static',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 14,
                        'visible' => false,
                        'used_in_product_listing' => true,
                    ],
                    'has_options' => [
                        'type' => 'static',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 15,
                        'visible' => false,
                    ],
                    'image_label' => [
                        'type' => 'varchar',
                        'label' => 'Image Label',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 16,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'visible' => false,
                        'used_in_product_listing' => true,
                    ],
                    'small_image_label' => [
                        'type' => 'varchar',
                        'label' => 'Small Image Label',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 17,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'visible' => false,
                        'used_in_product_listing' => true,
                    ],
                    'thumbnail_label' => [
                        'type' => 'varchar',
                        'label' => 'Thumbnail Label',
                        'input' => 'text',
                        'required' => false,
                        'sort_order' => 18,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_STORE,
                        'visible' => false,
                        'used_in_product_listing' => true,
                    ],
                    'created_at' => [
                        'type' => 'static',
                        'input' => 'text',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Time\Created',
                        'sort_order' => 19,
                        'visible' => false,
                    ],
                    'updated_at' => [
                        'type' => 'static',
                        'input' => 'text',
                        'backend' => 'Magento\Eav\Model\Entity\Attribute\Backend\Time\Updated',
                        'sort_order' => 20,
                        'visible' => false,
                    ],
                    'country_of_manufacture' => [
                        'type' => 'varchar',
                        'label' => 'Country of Manufacture',
                        'input' => 'select',
                        'source' => 'Magento\Catalog\Model\Product\Attribute\Source\Countryofmanufacture',
                        'required' => false,
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_WEBSITE,
                        'visible' => true,
                        'user_defined' => false,
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'visible_on_front' => false,
                        'unique' => false,
                        'apply_to' => 'simple,bundle',
                        'group' => 'General',
                    ],
                    'quantity_and_stock_status' => [
                        'group' => 'General',
                        'type' => 'int',
                        'backend' => 'Magento\Catalog\Model\Product\Attribute\Backend\Stock',
                        'label' => 'Quantity',
                        'input' => 'select',
                        'input_renderer' => 'Magento\CatalogInventory\Block\Adminhtml\Form\Field\Stock',
                        'source' => 'Magento\\CatalogInventory\\Model\\Source\\Stock',
                        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_GLOBAL,
                        'default' => \Magento\CatalogInventory\Model\Stock::STOCK_IN_STOCK,
                        'user_defined' => false,
                        'visible' => true,
                        'required' => false,
                        'searchable' => false,
                        'filterable' => false,
                        'comparable' => false,
                        'unique' => false,
                    ],
                ],
            ]
        ];
    }

    /**
     * Returns category entity row by category id
     *
     * @param int $entityId
     * @return array
     */
    protected function _getCategoryEntityRow($entityId)
    {
        $select = $this->getConnection()->select();

        $select->from($this->getTable('catalog_category_entity'));
        $select->where('entity_id = :entity_id');

        return $this->getConnection()->fetchRow($select, ['entity_id' => $entityId]);
    }

    /**
     * Returns category path as array
     *
     * @param array $category
     * @param array $path
     * @return string
     */
    protected function _getCategoryPath($category, $path = [])
    {
        $path[] = $category['entity_id'];

        if ($category['parent_id'] != 0) {
            $parentCategory = $this->_getCategoryEntityRow($category['parent_id']);
            if ($parentCategory) {
                $path = $this->_getCategoryPath($parentCategory, $path);
            }
        }

        return $path;
    }
}
