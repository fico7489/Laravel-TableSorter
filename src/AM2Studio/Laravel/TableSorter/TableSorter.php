<?php


namespace AM2Studio\Laravel\TableSorter;

class TableSorter
{
    public static function sort(array $headings, \Illuminate\Pagination\LengthAwarePaginator $paginator, array $config)
    {
        $sort_by = $config['sort_by'];
        $sort_type = $config['sort_type'];

        $string = '';
        foreach ($headings as $heading) {
            $name = $heading['name'];
            $title = $heading['title'];

            if ($sort_by != $name) {
                $sort_type_this = 'ASC';
            } else {
                if ($sort_type == 'ASC') {
                    $sort_type_this = 'DESC';
                } else {
                    $sort_type_this = 'ASC';
                }
            }

            $class = '';
            if ($sort_by == $name) {
                $class .= 'order-active ';
            }
			
			if ($sort_by == $name  &&  $sort_type_this == 'ASC') {
				$class .= 'order-asc ';
			}else{
				$class .= 'order-desc ';
			}
			
            if ($sort_type_this == 'ASC') {
                $class .= 'order-next-desc';
            } else {
                $class .= 'order-next-asc';
            }

            $paginator_tmp = clone $paginator;
            $string .= sprintf($config['template'],
                $class,
                $paginator_tmp->appends(['sort_by' => $name, 'sort_type' => $sort_type_this])->url($paginator_tmp->currentPage()),
                $title
            );
        }

        echo $string;
    }
}
