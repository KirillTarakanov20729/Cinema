<?php

namespace App\Http\Controllers\Actor;

use App\Application\Services\Actor\ActorService;
use App\Application\Services\Actor\DTO\IndexActorDTO;
use App\Domain\Models\Actor\Resource\ActorResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActorController extends Controller
{
    public function __construct(private readonly ActorService $service)
    {
    }

    public function index(int $page): JsonResponse|AnonymousResourceCollection
    {
        $data = new IndexActorDTO(['page' => $page]);

        try {
            $actors = $this->service->index($data);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return ActorResource::collection($actors);
    }
}
