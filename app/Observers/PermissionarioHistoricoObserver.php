<?php

namespace App\Observers;

use App\Models\Permissionario;

class PermissionarioHistoricoObserver
{
    /**
     * Handle the permissionario historico "created" event.
     *
     * @param  \App\Permissionario  $permissionario
     * @return void
     */
    public function created(Permissionario $permissionario)
    {
        //
    }

    /**
     * Handle the permissionario historico "updated" event.
     *
     * @param  \App\Permissionario  $permissionario
     * @return void
     */
    public function updated(Permissionario $permissionario)
    {
        $data = request()->all();

        foreach ($data as $key => $value) {
            if ($permissionario->isDirty($key)) {
                $permissionario->permissionarioHistorico()->create([
                    'campo' => $key,
                    'valor_antigo' => $permissionario->getOriginal($key),
                    'valor_novo' => $value,
                ]);
            }
        }
    }

    /**
     * Handle the permissionario historico "deleted" event.
     *
     * @param  \App\Permissionario  $permissionario
     * @return void
     */
    public function deleted(Permissionario $permissionario)
    {
        //
    }

    /**
     * Handle the permissionario historico "restored" event.
     *
     * @param  \App\Permissionario  $Permissionario
     * @return void
     */
    public function restored(Permissionario $permissionario)
    {
        //
    }

    /**
     * Handle the permissionario historico "force deleted" event.
     *
     * @param  \App\Permissionario  $Permissionario
     * @return void
     */
    public function forceDeleted(Permissionario $permissionario)
    {
        //
    }
}
