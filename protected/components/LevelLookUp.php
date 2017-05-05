<?php

class LevelLookUp{

      const GG="GG"; //Gerente General
      const GOP="GOP"; //Gerente Operaciones
      const ADM="ADM"; //Administrador  
      const JDP="JDP"; //Jefe Departamento
      const A1="A1"; //Jefe Departamento
      const PR="PR";
      const LOG="LOG";
      const OP="OP";
      const OTA="OTA";
      const MNT="MNT"; // Mantención
      // For CGridView, CListView Purposes

      public static function getLabel( $level ){

          if($level == self::GG)
             return 'GG';
          if($level == self::GOP)
             return 'GOP';
          if($level == self::ADM)
             return 'ADM';
          if($level == self::JDP)
             return 'JDP';
          if($level == self::A1)
             return 'A1';
          if($level == self::PR)
             return 'PR';
          if($level == self::LOG)
             return 'LOG';
          if($level == self::OP)
             return 'OP';
          if($level == self::OTA)
             return 'OTA';
           if($level == self::MNT)
             return 'MNT';
          return false;

      }

      // for dropdown lists purposes

      public static function getLevelList(){

          return array(
                self::GG=>'GG',
                self::GOP=>'GOP',
                self::ADM=>'ADM',
                self::JDP=>'JDP',
                self::A1=>'A1',
                self::PR=>'PR',
                self::LOG=>'LOG',
                self::OP=>'OP',
                self::OTA=>'OTA',
                self::MNT=>'MNT',
          ); 

    }

}


