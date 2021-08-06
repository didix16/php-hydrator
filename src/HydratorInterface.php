<?php


namespace didix16\Hydrator;

/**
 * A Basic Interface of what an hydrator is
 * A class to extract data from an object into an array and
 * fill porperties of an object given an array of data or any kind of object which acts as an array
 *
 * https://docs.laminas.dev/laminas-hydrator/v3/quick-start/#base_interfaces
 * http://www.webconsults.eu/blog/entry/108-What_is_a_Hydrator_in_Zend_Framework_2
 * https://wiki.php.net/rfc/object-typehint#make_code_easier_to_understand
 *
 * Interface HydratorInterface
 * @package didix16\Hydrator
 */
interface HydratorInterface extends Hydration, Extraction
{
}