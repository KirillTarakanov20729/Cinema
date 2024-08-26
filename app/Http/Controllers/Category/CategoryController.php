<?php

namespace App\Http\Controllers\Category;

use App\Application\Services\Category\CategoryService;
use App\Application\Services\Category\DTO\IndexCategoryDTO;
use App\Domain\Models\Category\Resource\CategoryResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @OA\Get (
 *     path="/api/categories/index/{page}",
 *     summary="Get all categories",
 *     tags={"Categories"},
 *
 *     @OA\Parameter(
 *         name="page",
 *         in="path",
 *         required=true,
 *     ),
 *
 *     @OA\Response(
 *         response="200",
 *         description="Get all categories",
 *     )
 * )
 */
class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $service)
    {
    }

    public function index(int $page): JsonResponse|AnonymousResourceCollection
    {
        $data = new IndexCategoryDTO(['page' => $page]);

        try {
            $categories = $this->service->index($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return CategoryResource::collection($categories);
    }
}
