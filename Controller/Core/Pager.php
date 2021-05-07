<?php

namespace Controller\Core;


class Pager
{

    protected $totalRecords = null;
    protected $recordPerPage = null;
    protected $noOfPages = null;
    protected $start = 1;
    protected $end = null;
    protected $next = null;
    protected $previous = null;
    protected $currentPage = 1;


    public function setTotalRecords(int $totalRecords)
    {
        $this->totalRecords = $totalRecords;
        return $this;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function setRecordPerPage(int $recordPerPage)
    {
        $this->recordPerPage = $recordPerPage;
        return $this;
    }

    public function getRecordPerPage()
    {
        return $this->recordPerPage;
    }

    protected function setNoOfPages($noOfPages)
    {
        $this->noOfPages = $noOfPages;
        return $this;
    }

    public function getNoOfPages()
    {
        return $this->noOfPages;
    }

    protected function setEnd($end)
    {
        $this->end = $end;
        return $this;
    }

    public function getEnd()
    {
        return $this->end;
    }

    protected function setStart($start)
    {
        $this->start = $start;
        return $this;
    }

    public function getStart()
    {
        return $this->start;
    }

    protected function setNext($next)
    {
        $this->next = $next;
        return $this;
    }

    public function getNext()
    {
        return $this->next;
    }

    protected function setPrevious($previous)
    {
        $this->previous = $previous;
        return $this;
    }

    public function getPrevious()
    {
        return $this->previous;
    }

    public function setCurrentPage(int $currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function calculate()
    {
        if ($this->getTotalRecords() <= $this->getRecordPerPage()) {
            $this->setNoOfPages(1);
            $this->setEnd(null);
            $this->setNext(null);
            $this->setPrevious(null);
            return $this;
        }

        $page = ceil($this->getTotalRecords() / $this->getRecordPerPage());
        $this->setNoOfPages($page);
        $this->setEnd($page);


        if ($this->getCurrentPage() > $this->getNoOfPages()) {
            $this->setCurrentPage($this->getNoOfPages());
        }

        if ($this->getCurrentPage() < $this->getStart()) {
            $this->setCurrentPage($this->getStart());
        }


        if ($this->getCurrentPage() == $this->getStart()) {
            $this->setPrevious(null);
            $this->setStart(1);
            if ($this->getCurrentPage() < $this->getNoOfPages()) {
                $this->setNext($this->getCurrentPage() + 1);
            }
            return $this;
        }



        if ($this->getCurrentPage() == $this->getEnd()) {
            $this->setNext(null);
            $this->setEnd(null);
            if ($this->getCurrentPage() >= $this->getNoOfPages()) {
                $this->setPrevious($this->getCurrentPage() - 1);
            }
            return $this;
        }

        if ($this->getCurrentPage() > $this->getStart() && $this->getCurrentPage() < $this->getEnd()) {
            $this->setPrevious($this->getCurrentPage() - 1);
            $this->setNext($this->getCurrentPage() + 1);
            return $this;
        }
        return $this;
    }
}
