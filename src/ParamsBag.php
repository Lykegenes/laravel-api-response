<?php
namespace Lykegenes\ApiResponse;

use Illuminate\Http\Request;

class ParamsBag
{

    /**
     * The Request instance
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Various request parameters
     * @var String
     */
    protected $page;
    protected $perPage;
    protected $sortColumn;
    protected $sortDirection;
    protected $searchQuery;
    protected $includes;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $this->parseParams();
    }

    /**
     * Parse the request parameters
     */
    private function parseParams()
    {
        $this->page          = $this->getParamValue('page', 1);
        $this->perPage       = $this->getParamValue('per_page', 10);
        $this->sortColumn    = $this->getParamValue('sort', null);
        $this->sortDirection = $this->getParamValue('order', 'asc');
        $this->searchQuery   = $this->getParamValue('search', null);
        $this->includes      = $this->getParamValue('include', null);
    }

    /**
     * Get the name of a request parameter from the user's configuration
     * @param  String $key This parameter's key
     * @return String      This parameter's name
     */
    public function getParamName($key)
    {
        return config('api-response.parameters.' . $key, $key);
    }

    /**
     * Get the value of a request parameter
     * @param  String $key    This parameter's key
     * @param  mixed $default The default value to return
     * @return mixed          This paramter's value
     */
    public function getParamValue($key, $default = null)
    {
        return $this->request->input($this->getParamName($key), $default);
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function getSortColumn()
    {
        return $this->sortColumn;
    }

    public function getSortDirection()
    {
        return $this->sortDirection;
    }

    public function getSearchQuery()
    {
        return $this->searchQuery;
    }

    public function getIncludes()
    {
        return $this->includes;
    }
}