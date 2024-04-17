<?php

namespace App\Services;

use App\Models\Professor;
use App\Models\User;
use App\Repositories\ProfessorRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class ProfessorService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected ProfessorRepository $professorRepository
    ) {
    }

    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->createUser($data);
            $this->professorRepository->createProfessor($user->id);
            DB::commit();
            return ['success' => true, 'message' => 'Professor created successfully.'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Failed to create professor: '.$e->getMessage()];
        }
    }

    public function delete(Professor $professor)
    {
        DB::beginTransaction();
        try {
            if (!$this->professorRepository->deleteProfessor($professor)) {
                throw new \Exception('Failed to delete professor.');
            }
            if ($professor->user && !$this->userRepository->deleteUser($professor->user)) {
                throw new \Exception('Failed to delete associated user.');
            }
            DB::commit();
            return ['success' => true, 'message' => 'Professor deleted successfully.'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'Deletion failed: '.$e->getMessage()];
        }
    }

    public function update(array $data, User $user)
    {
        DB::beginTransaction();
        try {
            if (substr($data['name'], 0, 6) !== 'Prof. ') {
                $data['name'] = 'Prof. '.$data['name'];
            }
            $data['password'] = '123';
            $user->update($data);
            DB::commit();
            return ['success' => true, 'message' => 'Professor updated successfully.'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => 'It failed: '.$e->getMessage()];
        }
    }
}
