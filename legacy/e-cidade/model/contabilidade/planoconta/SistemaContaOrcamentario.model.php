<?php
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2014  DBSeller Servicos de Informatica             
 *                            www.dbseller.com.br                     
 *                         e-cidade@dbseller.com.br                   
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt.txt 
 */


/**
* Classe respons�vel pelo comportamento do sistema de conta "Or�ament�rio"
* @author dbseller
* @name SistemaContaOrcamentario
* @package contabilidade
* @subpackage planoconta
*/

require_once 'model/contabilidade/planoconta/interface/ISistemaConta.interface.php';

class SistemaContaOrcamentario implements ISistemaConta {
  
  private $iCodigo    = 3;
  private $sDescricao = 'FINANCEIRO';

	/**
	 * M�todo que define o comportamento do sistema de conta
	 *
	 * @param ContaPlano $oContaPlano
	 * @return boolean
	 */
	public function integrarDados(ContaPlano $oContaPlano) {
		return true;
	}
	
 /**
	* @see ISistemaConta::excluirDadosIntegrados()
	*/
	public function excluirDadosIntegrados(ContaPlano $oContaPlano) {
	  return true;
	}
	
	/**
	* Retorna o c�digo do tipo Orcamentario
	* @see ISistemaConta::getCodigoSistemaConta()
	*/
	public function getCodigoSistemaConta() {
	  return $this->iCodigo;
	}
	
  public function getDescricao() {
    return $this->sDescricao;
  }
}
?>