
                                            <div class="filter_container flex  a_center">
                                             <div class="filter flex  ">
                                             <span class="tree">Trier par : </span>
                                                    <form class="flex t_date">
                                                      <label for="date" class="flex j_center a_center"> 
                                                     
                                                      <div class="round_select round_selected"></div>
                                                      <span>Date</span>
                                                      </label>
                                                      <input type="submit" value="" hidden id="date">
                                                    </form>
                                                    <form class="flex t_qantity" >
                                                      <label for="quantity"  class="flex j_center a_center">
                                                     
                                                      <div class="round_select"></div>
                                                      <span>Quantité</span>
                                                      </label>
                                                      <input type="submit" value="" hidden id="quantity">
                                                    </form>
                                                    <form class="flex t_quality">
                                                      <label for="quality"  class="flex j_center a_center">
                                                     
                                                      <div class="round_select"></div>
                                                      <span>Qualité</span>
                                                      </label>
                                                      <input type="submit" value="" hidden id="quality">
                                                    </form>
                                                    <form class="flex t_montant">
                                                    <label for="montant"  class="flex j_center a_center">
                                                   
                                                    <div class="round_select"></div>
                                                    <span>Montant</span>
                                                    </label>
                                                    <input type="submit" value="" hidden id="montant">
                                                  </form>
                
                                            </div>
                                                    <form class="flex t_year">
                                                        <label for="year">

                                                          <select name="years" id="year_s" >
                                                                <option value="tous" selected >Toutes les années </option>
                                                                <?php   echo all_available_years('current_year_not_selected');//all availabel years ?>
                                                            </select>
                                                          
                                                        </label>
                                                        <input type="submit" hidden id="year">
                                                    </form>
                                            </div>