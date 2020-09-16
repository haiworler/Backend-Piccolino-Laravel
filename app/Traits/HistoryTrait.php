<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\People\{History};

trait HistoryTrait
{

  /**
   * Registra el historial de las personas, Cargos
   */
  protected function registerHistoryPosition($history)
  {
    if ($history['type_people_id'] != 3) {
      $this->getLastRegisterHistoryType($history);
      History::create($history);
    }
  }

  /**
   * Consulta si la persona tiene un historial
   */
  private function getLastRegisterHistoryType($history)
  {
    $history = History::Where('people_id', $history['people_id'])->Where('history_type_id', $history['history_type_id'])->orderBy('created_at', 'DESC')->first();
    if ($history) {
      $history->update(['end_date' => date('Y-m-d H:i:s')]);
    }
  }

  /**
   * Registra el historial de las personas, Asignaturas dictadas
   */
  protected function registerHistorySubjects($history)
  {
    $Oldhistory = History::Where('people_id', $history['people_id'])->Where('semester_id', $history['semester_id'])->Where('subject_id', $history['subject_id'])->orderBy('created_at', 'DESC')->first();
    if (!$Oldhistory) {
      History::create($history);
    }
  }
}
