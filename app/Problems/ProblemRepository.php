<?php
namespace App\Problems;
use Illuminate\Database\Eloquent\Collection;
interface ProblemRepository
{
    public function search(string $query = ""): Collection;
}