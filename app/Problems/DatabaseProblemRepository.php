<?php
namespace App\Problems;
use App\Problem;
use Illuminate\Database\Eloquent\Collection;
class DatabaseProblemRepository implements ProblemRepository
{
    public function search(string $search = ""): Collection
    {
        return Problem::where(function ($query) use ($search) {
                return $query->where('subject', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->get();
    }
}