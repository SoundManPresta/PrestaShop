<?php
/**
 * 2007-2015 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2015 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
namespace PrestaShopBundle\Form\Admin\Product;

use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This form class is responsible to generate the basic product Warehouse combinations form
 */
class ProductWarehouseCombination extends CommonAbstractType
{
    private $translator;
    private $contextLegacy;
    private $idWarehouse;

    /**
     * Constructor
     *
     * @param int $idWarehouse The warehouse ID
     * @param object $translator
     * @param object $legacyContext
     */
    public function __construct($idWarehouse, $translator, $legacyContext)
    {
        $this->translator = $translator;
        $this->contextLegacy = $legacyContext->getContext();
        $this->idWarehouse = $idWarehouse;
    }

    /**
     * {@inheritdoc}
     *
     * Builds form
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('activated', 'checkbox', array(
            'required' => false,
            'label' => $this->translator->trans('Stored', [], 'AdminProducts')
        ))
        ->add('id_product_attribute', 'hidden')
        ->add('product_id', 'hidden')
        ->add('warehouse_id', 'hidden')
        ->add('location', 'text', array(
            'required' => false,
            'label' => $this->translator->trans('Location (optional)', [], 'AdminProducts')
        ));

        //set default minimal values for collection prototype
        $builder->setData([
            'warehouse_id' => $this->idWarehouse,
            'warehouse_activated' => false,
        ]);
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'product_warehouse_combination';
    }
}
