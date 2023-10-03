<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Base extends BaseController
{
    protected $header;
    protected $menu;
    protected $bc;

    /**
     * Menampilkan view
     * @param string $view
     * @param array $data
     * @return string
     */
    protected function tampil(string $view, array $data): string
    {
        $data["header"] = $this->header;
        $data["menu"] = $this->menu;
        $data["bc"] = $this->bc;
        return view($view, $data);
    }

    /**
     * Menetapkan nilai Menu
     * @param string $menu
     * @return \App\Controllers\Base
     */
    public function setMenu(string $menu): self
    {
        $this->menu = $menu;
        return $this;
    }

    /**
     * Menetapkan nilai Header
     * @param mixed $header
     * @return \App\Controllers\Base
     */
    public function setHeader($header): self
    {
        $this->header = $header;
        return $this;
    }

    /**
     * Menetapkan nilai BC
     * @param mixed $bc
     * @return \App\Controllers\Base
     */
    public function setBc($bc): self
    {
        $this->bc = $bc;
        return $this;
    }
}