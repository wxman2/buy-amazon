<?php

namespace Drupal\buy_amazon\Plugin\ComputedField;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\computed_field\Field\ComputedFieldDefinitionWithValuePluginInterface;
use Drupal\computed_field\Plugin\ComputedField\ComputedFieldBase;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @ComputedField(
 *   id = "buy_amazon_computedbuyamazon",
 *   label = @Translation("Computed buy Amazon"),
 *   field_type = "text",
 *   attach = {
 *     "scope" = "base",
 *     "field_name" = "buy_amazon_computedbuyamazon",
 *     "entity_types" = {
 *       "entity_test" = {},
 *     },
 *   }
 * )
 */
class Computedbuyamazon extends ComputedFieldBase {

  /**
   * {@inheritdoc}
   */
  public function ComputeValue(EntityInterface $host_entity, ComputedFieldDefinitionWithValuePluginInterface $computed_field_definition): array {
	if(!empty($host_entity->field_isbn10->value)) {
		$ISBN = $host_entity->field_isbn10->value;
	}else{
		if(!empty($host_entity->field_amazon_asin->value)) {
			$ISBN = $host_entity->field_amazon_asin->value;
		}else{
			$ISBN = '';
		}
	}
	if(!empty($ISBN)) {
		$value = '<a href="http://www.amazon.com/gp/product/'.$ISBN.'" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />';
        return [
            0 => [
            'value' => $value,
            'format' => 'full_html',
            ],
        ];    
	}
  }

}