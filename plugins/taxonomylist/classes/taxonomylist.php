<?php
namespace Grav\Plugin;

use \Grav\Common\Registry;

class Taxonomylist
{
    /**
     * @var array
     */
    protected $taxonomylist;

    /**
     * Get taxonomy list.
     *
     * @return array
     */
    public function get()
    {
        if (!$this->taxonomylist) {
            $this->build();
        }
        return $this->taxonomylist;
    }

    /**
     * @internal
     */
    protected function build()
    {
        $taxonomylist = Registry::get('Taxonomy')->taxonomy();
        foreach ($taxonomylist as $x => $y) {
            foreach ($taxonomylist[$x] as $key => $value) {
                $taxonomylist[$x][$key] = count($value);
            }
            array_multisort($taxonomylist[$x], SORT_DESC, SORT_NUMERIC);
        }
        $this->taxonomylist = $taxonomylist;
    }
}
