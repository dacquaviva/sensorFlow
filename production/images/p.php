<html>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">

					 <FORM ID="log" NAME="log" ACTION="'. $_SERVER["PHP_SELF"].'"METHOD="POST" class="form-horizontal form-label-left" novalidate>
                


                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="nome" class="form-control col-md-7 col-xs-12" name="nome" type="text" required>
                        </div>
                      </div>
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Cognome <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="cognome" class="form-control col-md-7 col-xs-12"  name="cognome"  required="required" type="text">
                        </div>
                      </div>
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="surname">Azienda <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="azienda" class="form-control col-md-7 col-xs-12"  name="azienda"  required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Conferma Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email2" name="email2" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Tipologia di utente <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <label class="radio-inline"><input type="radio" name="tipologia" value=1>Amministratore</label>
                        <label class="radio-inline"><input value=0 type="radio" name="tipologia">Cliente</label>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="submit" name="submit" type="submit" class="btn btn-success">Inserisci</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>
	</html>