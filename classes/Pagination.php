<?php
class Pagination
{
    private $page,
            $items_per_page,
            $total_records;

    public function __construct($page,$items_per_page,$total_records)
    {
        $this->page = $page;
        $this->items_per_page = $items_per_page;
        $this->total_records = $total_records;
    }

    public function currentPage()
    {
        return $this->page;
    }

    public function totalPages()
    {
        return ceil($this->total_records/$this->items_per_page);
    }

    public function next()
    {
        return $this->page + 1;
    }

    public function previous()
    {
        return $this->page -1;
    }

    public function hasNext()
    {
        return ($this->next() <= $this->currentPage()) ? true : false;
    }

    public function hasPrevious()
    {
        return ($this->previous() >= 1) ? true : false;
    }

    public function offset()
    {
        return ($this->currentPage()-1) * $this->items_per_page;
    }
}