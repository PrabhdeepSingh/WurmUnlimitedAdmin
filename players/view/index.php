<?php
$page = "player";
require("../../header.php");
?>
  <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css" />
  <div class="content-wrapper">
    <section class="content-header">
      <h1>Player Profile</h1>
    </section>

    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <div class="box box-primary">
            <div class="box-body box-profile" id="1stDiv" style="display: none;">
              <img class="profile-user-img img-responsive img-circle" id="playerImage" src="" alt="User profile picture">

              <h3 class="profile-username text-center" id="playerName"></h3>
              <p class="text-muted text-center" id="playerPower"></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>IP</b> <a class="pull-right" id="playerIP"></a>
                </li>
                <li class="list-group-item">
                  <b>First seen</b> <a class="pull-right" id="playerFirstSeen"></a>
                </li>
                <li class="list-group-item">
                  <b>Last seen</b> <a class="pull-right" id="playerLastSeen"></a>
                </li>
                <li class="list-group-item">
                  <b>Play time</b> <a class="pull-right" id="playerPlayTime"></a>
                </li>
                <li class="list-group-item">
                  <b>Banned</b> <a class="pull-right" id="playerIsBanned"></a>
                </li>
                <li class="list-group-item" id="liPlayerBanTime" style="display:none">
                  <b>Banned until</b> <a class="pull-right" id="playerBanTime"></a>
                </li>
                <li class="list-group-item" id="liPlayerBanReason" style="display:none">
                  <b>Banned reason</b> <a class="pull-right" id="playerBanReason"></a>
                </li>
                <li class="list-group-item">
                  <b>Muted</b> <a class="pull-right" id="playerMuted"></a>
                </li>
                <li class="list-group-item" id="liPlayerMuteTime" style="display:none">
                  <b>Muted until</b> <a class="pull-right" id="playerMuteTime"></a>
                </li>
                <li class="list-group-item" id="liPlayerMuteReason" style="display:none">
                  <b>Muted reason</b> <a class="pull-right" id="playerMuteReason"></a>
                </li>
              </ul>
              <button class="btn btn-block" id="btnMuteUnmute" data-do=""></button>
              <button class="btn btn-block" id="btnBanUnBan" data-do=""></button>
              <button class="btn btn-primary btn-block" id="btnChangePower">Change power</button>
            </div>
            <div class="loading" id="loader-0"></div>

          </div>

        </div>

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#info" data-toggle="tab">Info</a></li>
              <li><a href="#inventory" data-toggle="tab" onclick="$('#btnRefreshInventory').trigger('click');">Inventory</a></li>
              <li><a href="#skills" data-toggle="tab" onclick="$('#btnRefreshSkills').trigger('click');">Skills</a></li>
            </ul>
            <div class="tab-content" id="2ndDiv" style="display: none;">
              <div class="active tab-pane" id="info">
                <div class="row">
                  <div class="col-sm-9 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Money</h5>
                      <span class="description-text" id="playerMoney"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="description-block">
                      <a id="btnAddMoney" class="btn btn-success form-control">Add money</a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Email</h5>
                      <span class="description-text" id="playerEmail"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="description-block">
                      <a id="btnChangeEmail" class="btn btn-primary form-control">Change email</a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9">
                    <div class="description-block">
                      <h5 class="description-header">Cheated</h5>
                      <span class="description-text" id="playerCheated"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9">
                    <div class="description-block">
                      <h5 class="description-header">Mute count</h5>
                      <span class="description-text" id="playerMuteCount"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Kingdom</h5>
                      <span class="description-text" id="playerKingdom"></span>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="description-block">
                      <a id="btnChangeKingdom" class="btn btn-primary form-control">Change kingdom</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="inventory">
                <div class="box no-border">
                  <div class="box-header">
                    <h3 class="box-title">Player Inventory</h3>

                    <div class="box-tools">
                      <a href="#" class="btn btn-success" onclick="$('#modalAddItem').modal('show');">Add item</a>
                      <a href="#" class="btn btn-primary" id="btnRefreshInventory">Refresh inventory</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                    <div class="row" id="invFirstLoad">
                      <div class="col-md-12"><div class="text-center"><h3>Please click on 'Refresh invenory' button on the top right</h3></div></div>
                    </div>
                    <table class="table table-hover" id="tableInventory" style="display: none;">
                      <thead>
                        <th></th>
                        <th>Item</th>
                        <th>Rarity</th>
                        <th>Orginal Quality</th>
                        <th>Quality</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
              <div class="tab-pane" id="skills">
                <div class="box no-border">
                  <div class="box-header">
                    <h3 class="box-title">Player Skills</h3>

                    <div class="box-tools">
                      <a href="#" class="btn btn-primary" id="btnRefreshSkills">Refresh skills</a>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body table-responsive no-padding">
                    <div class="row" id="skillsFirstLoad">
                      <div class="col-md-12"><div class="text-center"><h3>Please click on 'Refresh skills' button on the top right</h3></div></div>
                    </div>
                    <table class="table table-hover" id="tableSkills" style="display: none;">
                      <thead>
                        <th>Skill</th>
                        <th>Min Value</th>
                        <th>Current Value</th>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
              </div>
            </div>
            <div class="loading" id="loader-1"></div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <div class="modal" id="modalBan" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Ban player</h4>
        </div>
        <div class="modal-body" id="modalBanLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formBanPlayer">
          <div class="modal-body">
            <div class="form-group">
              <label>How many days?</label>
              <input type="number" class="form-control" id="txtBanDays" placeholder="Enter how many days to ban player" />
            </div>
            <div class="form-group">
              <label>Reason</label>
              <input type="text" class="form-control" id="txtBanReason" placeholder="Reason for ban" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Ban!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal" id="modalMute" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Mute player</h4>
        </div>
        <div class="modal-body" id="modalMuteLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formMutePlayer">
          <div class="modal-body">
            <div class="form-group">
              <label>How many hours?</label>
              <input type="number" class="form-control" id="txtMuteHours" placeholder="Enter how many hours to mute player" />
            </div>
            <div class="form-group">
              <label>Reason</label>
              <input type="text" class="form-control" id="txtMuteReason" placeholder="Reason for mute" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Mute!</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal" id="modalAddItem" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Add item</h4>
        </div>
        <div class="modal-body" id="modalAddItemLoader" style="display:none;"><div class="loading"></div></div>
        <form role="form" id="formAddItem">
          <div class="modal-body">
            <div class="form-group">
              <label>Item(s) to give</label>
              <select id="txtItemID" class="full-width" multiple="multiple">
                <option value="2">SATCHEL</option>
                <option value="3">AXE SMALL</option>
                <option value="4">SHIELD MEDIUM</option>
                <option value="5">POTION</option>
                <option value="6">APPLE GREEN</option>
                <option value="7">HATCHET</option>
                <option value="8">KNIFE CARVING</option>
                <option value="9">LOG</option>
                <option value="20">PICK AXE</option>
                <option value="21">SWORD LONG</option>
                <option value="22">PLANK</option>
                <option value="23">SHAFT</option>
                <option value="24">SAW</option>
                <option value="25">SHOVEL</option>
                <option value="26">DIRT PILE</option>
                <option value="27">RAKE</option>
                <option value="28">BARLEY</option>
                <option value="29">WHEAT</option>
                <option value="30">RYE</option>
                <option value="31">OAT</option>
                <option value="32">CORN</option>
                <option value="33">PUMPKIN</option>
                <option value="34">PUMPKIN SEED</option>
                <option value="35">POTATO</option>
                <option value="36">KINDLING</option>
                <option value="37">CAMPFIRE</option>
                <option value="38">IRON ORE</option>
                <option value="39">GOLD ORE</option>
                <option value="40">SILVER ORE</option>
                <option value="41">LEAD ORE</option>
                <option value="42">ZINC ORE</option>
                <option value="43">COPPER ORE</option>
                <option value="44">GOLD LUMP</option>
                <option value="45">SILVER LUMP</option>
                <option value="46">IRON LUMP</option>
                <option value="47">COPPER LUMP</option>
                <option value="48">ZINC LUMP</option>
                <option value="49">LEAD LUMP</option>
                <option value="50">COIN COPPER</option>
                <option value="51">COIN IRON</option>
                <option value="52">COIN SILVER</option>
                <option value="53">COIN GOLD</option>
                <option value="54">COIN COPPER FIVE</option>
                <option value="55">COIN IRONFIVE</option>
                <option value="56">COIN SILVER FIVE</option>
                <option value="57">COIN GOLD FIVE</option>
                <option value="58">COIN COPPER TWENTY</option>
                <option value="59">COIN IRON TWENTY</option>
                <option value="60">COIN SILVER TWENTY</option>
                <option value="61">COIN GOLD TWENTY</option>
                <option value="62">HAMMER METAL</option>
                <option value="63">HAMMER WOOD</option>
                <option value="64">ANVIL SMALL</option>
                <option value="65">CHEESE DRILL</option>
                <option value="66">CHEESE COW</option>
                <option value="67">CHEESE GOAT</option>
                <option value="68">CHEESE FETA</option>
                <option value="69">CHEESE BUFFALO</option>
                <option value="70">HONEY</option>
                <option value="71">ANIMAL HIDE</option>
                <option value="72">LEATHER</option>
                <option value="73">LYE</option>
                <option value="74">CHARCOAL PILE</option>
                <option value="75">FRYING PAN</option>
                <option value="76">JAR POTTERY</option>
                <option value="77">BOWL POTTERY</option>
                <option value="78">FLASK POTTERY</option>
                <option value="79">SKIN WATER</option>
                <option value="80">SWORD SHORT</option>
                <option value="81">SWORD TWOHANDER</option>
                <option value="82">SHIELD SMALL WOOD</option>
                <option value="83">SHIELD SMALL METAL</option>
                <option value="84">SHIELD MEDIUM WOOD</option>
                <option value="85">SHIELD LARGE WOOD</option>
                <option value="86">SHIELD LARGE METAL</option>
                <option value="87">AXE HUGE</option>
                <option value="88">AXE HEAD HUGE</option>
                <option value="89">AXE HEAD SMALL</option>
                <option value="90">AX EMEDIUM</option>
                <option value="91">AXE HEAD MEDIUM</option>
                <option value="92">MEAT</option>
                <option value="93">KNIFE BUTCHERING</option>
                <option value="94">FISHING ROD IRON HOOK</option>
                <option value="95">FISHING HOOK IRON</option>
                <option value="96">FISHING HOOK WOOD</option>
                <option value="97">STONE CHISEL</option>
                <option value="98">SCAB BARD LEATHER</option>
                <option value="99">WOODENHAND LESWORD</option>
                <option value="100">LEATHER STRIP</option>
                <option value="101">WOODEN LEATHER HANDLE WORD</option>
                <option value="102">BELT LEATHER</option>
                <option value="103">LEATHER GLOVE</option>
                <option value="104">LEATHER JACKET</option>
                <option value="105">LEATHER BOOT</option>
                <option value="106">LEATHER SLEEVE</option>
                <option value="107">LEATHER CAP</option>
                <option value="108">LEATHER HOSE</option>
                <option value="109">CLOTH GLOVE</option>
                <option value="110">CLOTH SHIRT</option>
                <option value="111">CLOTH SLEEVE</option>
                <option value="112">CLOTH JACKET</option>
                <option value="113">CLOTH HOSE</option>
                <option value="114">CLOTH SHOES</option>
                <option value="115">STUDDED LEATHER SLEEVE</option>
                <option value="116">STUDDED LEATHER BOOT</option>
                <option value="117">STUDDED LEATHER CAP</option>
                <option value="118">STUDDED LEATHER HOSE</option>
                <option value="119">STUDDED LEATHER GLOVE</option>
                <option value="120">STUDDED LEATHER JACKET</option>
                <option value="121">SHOVEL BLADE METAL</option>
                <option value="122">SHOVEL BLADE WOOD</option>
                <option value="123">PICK BLADE IRON</option>
                <option value="124">RAKE BLADE</option>
                <option value="125">KNIFE BLADE BUTCHERING</option>
                <option value="126">KNIFE BLADE CARVING</option>
                <option value="127">HAMMER HEAD METAL</option>
                <option value="128">WATER</option>
                <option value="129">COOKED MEAT</option>
                <option value="130">CLAY</option>
                <option value="131">METAL RIVET</option>
                <option value="132">STONE BRICK</option>
                <option value="133">CANDLE</option>
                <option value="134">NUT HAZEL</option>
                <option value="135">LANTERN</option>
                <option value="136">OIL LAMP</option>
                <option value="137">LAMP OIL</option>
                <option value="138">TORCH</option>
                <option value="139">SPINDLE</option>
                <option value="140">TALLOW</option>
                <option value="141">ASH</option>
                <option value="142">MILK COW</option>
                <option value="143">FLINT STEEL</option>
                <option value="144">COTTON</option>
                <option value="145">COTTON SEED</option>
                <option value="146">ROCK</option>
                <option value="147">SWORD BLADE SHORT</option>
                <option value="148">SWORD BLADE LONG</option>
                <option value="149">SWORD BLADE TWO HANDED</option>
                <option value="150">FISHING HOOK IRONANDSTRING</option>
                <option value="151">FISHING HOOK WOODANDSTRING</option>
                <option value="152">FISHING ROD WOODENHOOK</option>
                <option value="153">TAR</option>
                <option value="154">CHISEL BLADE</option>
                <option value="155">BREAD WHEAT</option>
                <option value="156">HAMMER HEAD WOOD</option>
                <option value="157">DEAD PIKE</option>
                <option value="158">DEAD BASS</option>
                <option value="159">DEAD HERRING</option>
                <option value="160">DEAD CATFISH</option>
                <option value="161">DEAD SNOOK</option>
                <option value="162">DEAD ROACH</option>
                <option value="163">DEAD PERCH</option>
                <option value="164">DEAD CARP</option>
                <option value="165">DEAD TROUT</option>
                <option value="166">WRIT OF OWNERSHIP</option>
                <option value="167">DOOR LOCK</option>
                <option value="168">KEY</option>
                <option value="169">SCRAP WOOD</option>
                <option value="170">SCRAP IRON</option>
                <option value="171">RAGS</option>
                <option value="172">LEATHER PIECES</option>
                <option value="173">PIG FOOD</option>
                <option value="174">WAND TELEPORT</option>
                <option value="175">PRESENT</option>
                <option value="176">WAND DEITY</option>
                <option value="177">ITEM PILE</option>
                <option value="178">STONE OVEN</option>
                <option value="179">UNFINISHED ITEM</option>
                <option value="180">FORGE</option>
                <option value="181">JARCLAY</option>
                <option value="182">BOWLCLAY</option>
                <option value="183">FLASK CLAY</option>
                <option value="184">CHEST LARGE</option>
                <option value="185">ANVIL LARGE</option>
                <option value="186">CARTSMALL</option>
                <option value="187">WHEELSMALL</option>
                <option value="188">IRONBAND</option>
                <option value="189">BARREL SMALL</option>
                <option value="190">BARREL LARGE</option>
                <option value="191">WHEELAXLESMALL</option>
                <option value="192">CHESTSMALL</option>
                <option value="193">PADLOCKSMALL</option>
                <option value="194">PADLOCK LARGE</option>
                <option value="195">SCRAP COPPER</option>
                <option value="196">SCRAPGOLD</option>
                <option value="197">SCRAPSILVER</option>
                <option value="198">SCRAPZINC</option>
                <option value="199">SCRAPLEAD</option>
                <option value="200">DOUGH</option>
                <option value="201">FLOUR</option>
                <option value="202">GRINDSTONE</option>
                <option value="203">BREAD</option>
                <option value="204">CHARCOAL</option>
                <option value="205">STEEL LUMP</option>
                <option value="206">SCRAPSTEEL</option>
                <option value="207">TIN ORE</option>
                <option value="208">SIGNPOIN TING</option>
                <option value="209">SIGN LARGE</option>
                <option value="210">SIGNSMALL</option>
                <option value="211">DEED VILLAGE TEN</option>
                <option value="212">COTTONBALE</option>
                <option value="213">CLOTH YARD</option>
                <option value="214">CLOTH STRING</option>
                <option value="215">NEEDLE IRON</option>
                <option value="216">NEEDLE COPPER</option>
                <option value="217">NAILS IRON LARGE</option>
                <option value="218">NAILS IRONSMALL</option>
                <option value="219">PLIERS</option>
                <option value="220">TIN LUMP</option>
                <option value="221">BRASS LUMP</option>
                <option value="222">SCRAP TIN</option>
                <option value="223">BRONZE LUMP</option>
                <option value="224">SCRAP BRONZE</option>
                <option value="225">SCRAP BRASS</option>
                <option value="226">LOOM</option>
                <option value="227">STATUETTE</option>
                <option value="228">CANDELABRA</option>
                <option value="229">CHAIN</option>
                <option value="230">NECKLACE</option>
                <option value="231">ARMRING</option>
                <option value="232">BALL</option>
                <option value="233">PENDULUM</option>
                <option value="234">DEED HOMESTEADFIVE</option>
                <option value="236">VILLAGETOKEN</option>
                <option value="237">DEED VILLAGE FIVE</option>
                <option value="238">DEED VILLAGE FIFTEEN</option>
                <option value="239">DEED VILLAGE TWENTY</option>
                <option value="242">DEED VILLAGE FIFTY</option>
                <option value="244">DEED VILLAGE HUNDRED</option>
                <option value="245">DEED VILLAGE TWOHUNDRED</option>
                <option value="246">MUSHROOM GREEN</option>
                <option value="247">MUSHROOM BLACK</option>
                <option value="248">MUSHROOM BROWN</option>
                <option value="249">MUSHROOM YELLOW</option>
                <option value="250">MUSHROOM BLUE</option>
                <option value="251">MUSHROOM RED</option>
                <option value="252">GATE LOCK</option>
                <option value="253">DEED HOMESTEADTEN</option>
                <option value="254">DEED HOMESTEADTWENTY</option>
                <option value="257">SPOON</option>
                <option value="258">KNIFEFOOD</option>
                <option value="259">FORK</option>
                <option value="260">TABLE ROUND</option>
                <option value="261">STOOL ROUND</option>
                <option value="262">TABLESQUARESMALL</option>
                <option value="263">CHAIR</option>
                <option value="264">TABLE SQUARE LARGE</option>
                <option value="265">ARMCHAIR</option>
                <option value="266">SPROUT</option>
                <option value="267">SICKLE</option>
                <option value="268">SCYTHE</option>
                <option value="269">SICKLE BLADE</option>
                <option value="270">SCYTHE BLADE</option>
                <option value="271">YOYO</option>
                <option value="272">CORPSE</option>
                <option value="273">GLOVESTEEL</option>
                <option value="274">CHAINBOOT</option>
                <option value="275">CHAINHOSE</option>
                <option value="276">CHAINJACKET</option>
                <option value="277">CHAINSLEEVE</option>
                <option value="278">CHAIN GLOVE</option>
                <option value="279">CHAINCOIF</option>
                <option value="280">PLATEBOOT</option>
                <option value="281">PLATEHOSE</option>
                <option value="282">PLATEJACKET</option>
                <option value="283">PLATESLEEVE</option>
                <option value="284">PLATEGAUNTLET</option>
                <option value="285">HELMETBASINET</option>
                <option value="286">HELMETGREAT</option>
                <option value="287">HELMETOPEN</option>
                <option value="288">ARMOURCHAINS</option>
                <option value="289">RAFTSMALL</option>
                <option value="290">MAUL LARGE</option>
                <option value="291">MAULSMALL</option>
                <option value="292">MAULMEDIUM</option>
                <option value="293">MAULHEAD LARGE</option>
                <option value="294">MAULHEADSMALL</option>
                <option value="295">MAULHEADMEDIUM</option>
                <option value="296">WHETSTONE</option>
                <option value="297">RING</option>
                <option value="298">SAND</option>
                <option value="299">TRADERCONTRACT</option>
                <option value="300">MERCHANTCONTRACT</option>
                <option value="301">CORNUCOPIA</option>
                <option value="302">FUR</option>
                <option value="303">TOOTH</option>
                <option value="304">HORN</option>
                <option value="305">PAW</option>
                <option value="306">HOOF</option>
                <option value="307">TAIL</option>
                <option value="308">EYE</option>
                <option value="309">BLADDER</option>
                <option value="310">GLAND</option>
                <option value="311">HORNTWISTED</option>
                <option value="312">HORNLONG</option>
                <option value="313">PELT</option>
                <option value="314">CLUB HUGE</option>
                <option value="315">WANDGM</option>
                <option value="316">WEMP</option>
                <option value="317">WEMPSEED</option>
                <option value="318">WEMPFIBRE</option>
                <option value="319">ROPE</option>
                <option value="320">ROPETOOL</option>
                <option value="321">PRACTICEDOLL</option>
                <option value="322">ALTAR WOOD</option>
                <option value="323">ALTARSTONE</option>
                <option value="324">ALTARGOLD</option>
                <option value="325">ALTARSILVER</option>
                <option value="326">METALBOWL</option>
                <option value="327">ALTARHOLY</option>
                <option value="328">ALTARUNHOLY</option>
                <option value="329">RODBEGUILING</option>
                <option value="330">CROWN MIGHT</option>
                <option value="331">CHARMOFFO</option>
                <option value="332">VYNORASEYE</option>
                <option value="333">VYNORASEAR</option>
                <option value="334">VYNORASMOUTH</option>
                <option value="335">FINGEROFFO</option>
                <option value="336">SWORDOFMAGRANON</option>
                <option value="337">HAMMEROFMAGRANON</option>
                <option value="338">LIBILASSCALE</option>
                <option value="339">ORBOFDOOM</option>
                <option value="340">SCEPTREOFASCENSION</option>
                <option value="341">KEYCOPY</option>
                <option value="342">KEYMOLD</option>
                <option value="343">KEYFORM</option>
                <option value="344">TEMPMARKER</option>
                <option value="345">STEW</option>
                <option value="346">CASSEROLE</option>
                <option value="347">STEAK</option>
                <option value="348">GULASCH</option>
                <option value="349">SALT</option>
                <option value="350">SAUCEPAN</option>
                <option value="351">CAULDRON</option>
                <option value="352">SOUP</option>
                <option value="353">LOVAGE</option>
                <option value="354">SAGE</option>
                <option value="355">ONION</option>
                <option value="356">GARLIC</option>
                <option value="357">OREGANO</option>
                <option value="358">PARSLEY</option>
                <option value="359">BASIL</option>
                <option value="360">THYME</option>
                <option value="361">BELLADONNA</option>
                <option value="362">STRAWBERRIES</option>
                <option value="363">ROSEMARY</option>
                <option value="364">BLUEBERRY</option>
                <option value="365">NETTLES</option>
                <option value="366">SASSAFRAS</option>
                <option value="367">LINGONBERRY</option>
                <option value="368">FILETMEAT</option>
                <option value="369">FILETFISH</option>
                <option value="370">DIAMONDCRAZY</option>
                <option value="371">DRAKEHIDE</option>
                <option value="372">DRAGONSCALE</option>
                <option value="373">PORRIDGE</option>
                <option value="374">EMERALD</option>
                <option value="375">EMERALDSTAR</option>
                <option value="376">RUBY</option>
                <option value="377">RUBYSTAR</option>
                <option value="378">OPAL</option>
                <option value="379">OPALBLACK</option>
                <option value="380">DIAMOND</option>
                <option value="381">DIAMONDSTAR</option>
                <option value="382">SAPPHIRE</option>
                <option value="383">SAPPHIRESTAR</option>
                <option value="384">GUARD TOWER</option>
                <option value="385">LOG HUGE</option>
                <option value="386">UNFINISHEDSIMPLEITEM</option>
                <option value="387">ILLUSIONARYITEM</option>
                <option value="388">FILE</option>
                <option value="389">FILE BLADE</option>
                <option value="390">AWL</option>
                <option value="391">AWL BLADE</option>
                <option value="392">LEATHERKNIFE</option>
                <option value="393">LEATHERKNIFE BLADE</option>
                <option value="394">SCISSORS</option>
                <option value="395">SCISSOR BLADE</option>
                <option value="396">CLAYSHAPER</option>
                <option value="397">SPATULA</option>
                <option value="398">STATUE NYMPH</option>
                <option value="399">STATUE DEMON</option>
                <option value="400">STATUE DOG</option>
                <option value="401">STATUE TROLL</option>
                <option value="402">STATUE BOY</option>
                <option value="403">STATUE GIRL</option>
                <option value="404">STONEBENCH</option>
                <option value="405">STONEFOUNTAINDRINK</option>
                <option value="406">STONESLAB</option>
                <option value="407">STONECOFFIN</option>
                <option value="408">STONEFOUNTAIN</option>
                <option value="409">CHERRIES</option>
                <option value="410">LEMON</option>
                <option value="411">GRAPESBLUE</option>
                <option value="412">OLIVE</option>
                <option value="413">FRUITPRESS</option>
                <option value="414">GRAPESGREEN</option>
                <option value="415">SYRUPMAPLE</option>
                <option value="416">SAPMAPLE</option>
                <option value="417">FRUITJUICE</option>
                <option value="418">OLIVEOIL</option>
                <option value="419">WINERED</option>
                <option value="420">WINEWHITE</option>
                <option value="421">BUCKETSMALL</option>
                <option value="422">LEAVESCAMELLIA</option>
                <option value="423">LEAVESOLEANDER</option>
                <option value="424">FLOWERLAVENDER</option>
                <option value="425">TEAGREEN</option>
                <option value="426">FLOWERROSE</option>
                <option value="427">LEMONADE</option>
                <option value="428">JAM</option>
                <option value="429">JOISTS</option>
                <option value="430">GUARD TOWERHOTS</option>
                <option value="431">DYEBLACK</option>
                <option value="432">DYEWHITE</option>
                <option value="433">DYERED</option>
                <option value="434">DYEBLUE</option>
                <option value="435">DYEGREEN</option>
                <option value="436">ACORN</option>
                <option value="437">TANNIN</option>
                <option value="438">DYE</option>
                <option value="439">COCHINEAL</option>
                <option value="440">WOAD</option>
                <option value="441">METALBRUSH</option>
                <option value="442">JULBORD</option>
                <option value="443">BAGKEEPING</option>
                <option value="444">METALWIRES</option>
                <option value="445">CATAPULT</option>
                <option value="446">FLINT</option>
                <option value="447">BOWSHORT</option>
                <option value="448">BOWMEDIUM</option>
                <option value="449">BOWLONG</option>
                <option value="450">BOWCOMPOSITE</option>
                <option value="451">ARROWHEADHUNTER</option>
                <option value="452">ARROWHEADWAR</option>
                <option value="453">ARROWHEAD</option>
                <option value="454">ARROWSHAFT</option>
                <option value="455">ARROWHUN TING</option>
                <option value="456">ARROWWAR</option>
                <option value="457">BOWSTRING</option>
                <option value="458">ARCHERYTARGET</option>
                <option value="459">BOWSHORTNOSTRING</option>
                <option value="460">BOWMEDIUMNOSTRING</option>
                <option value="461">BOWLONGNOSTRING</option>
                <option value="462">QUIVER</option>
                <option value="463">LOCKPICK</option>
                <option value="464">EGGSMALL</option>
                <option value="465">EGG LARGE</option>
                <option value="466">EGGEASTER</option>
                <option value="467">PEAT</option>
                <option value="468">DRAGONLEATHERSLEEVE</option>
                <option value="469">DRAGONLEATHERBOOT</option>
                <option value="470">DRAGONLEATHERCAP</option>
                <option value="471">DRAGONLEATHERHOSE</option>
                <option value="472">DRAGONLEATHER GLOVE</option>
                <option value="473">DRAGONLEATHERJACKET</option>
                <option value="474">DRAGONSCALEBOOT</option>
                <option value="475">DRAGONSCALEHOSE</option>
                <option value="476">DRAGONSCALEJACKET</option>
                <option value="477">DRAGONSCALESLEEVE</option>
                <option value="478">DRAGONSCALEGAUNTLET</option>
                <option value="479">MOSS</option>
                <option value="480">COMPASS</option>
                <option value="481">WOUNDCOVER</option>
                <option value="482">BEDHEADBOARD</option>
                <option value="483">BEDFRAME</option>
                <option value="484">BEDSTANDARD</option>
                <option value="485">BEDFOOTBOARD</option>
                <option value="486">SHEET</option>
                <option value="487">FLAG</option>
                <option value="488">SANDWICH</option>
                <option value="489">SPYGLASS</option>
                <option value="490">BOATROWING</option>
                <option value="491">BOATSAILING</option>
                <option value="492">MORTAR</option>
                <option value="493">TROWEL</option>
                <option value="494">TROWEL BLADE</option>
                <option value="495">FLOORBOARDS</option>
                <option value="496">STREETLAMP</option>
                <option value="497">LAMPHEAD</option>
                <option value="498">FLOWER1</option>
                <option value="499">FLOWER2</option>
                <option value="500">FLOWER3</option>
                <option value="501">FLOWER4</option>
                <option value="502">FLOWER5</option>
                <option value="503">FLOWER6</option>
                <option value="504">FLOWER7</option>
                <option value="505">STATUE TTEFO</option>
                <option value="506">STATUE TTELIBILA</option>
                <option value="507">STATUE TTEMAGRANON</option>
                <option value="508">STATUE TTEVYNORA</option>
                <option value="509">RESURRECTIONSTONE</option>
                <option value="510">MAILBOX WOOD</option>
                <option value="511">MAILBOXSTONE</option>
                <option value="512">MAILBOX WOODTWO</option>
                <option value="513">MAILBOXSTONETWO</option>
                <option value="514">WHIPONE</option>
                <option value="515">STEELCROWN</option>
                <option value="516">TOOLBELT</option>
                <option value="517">METALHOOKS</option>
                <option value="518">COLOSSUS</option>
                <option value="519">COLOSSUS PART</option>
                <option value="520">FIRE MARKER</option>
                <option value="522">PUMPKIN HALLOWEEN</option>
                <option value="523">AXE HEAD HATCHET</option>
                <option value="524">TELEPORTATION TWIG</option>
                <option value="525">TELEPORTATION STONE</option>
                <option value="526">WAND NATURE</option>
                <option value="527">FARWALKERAMULET</option>
                <option value="528">GUARD TOWER MOL</option>
                <option value="529">SCEPTRE ROYAL JENN</option>
                <option value="530">CROWN ROYAL JENN</option>
                <option value="531">ROBES ROYAL JENN</option>
                <option value="532">SCEPTRE ROYAL MOLR</option>
                <option value="533">CROWN ROYAL MOLR</option>
                <option value="534">ROBES ROYAL MOLR</option>
                <option value="535">SCEPTRE ROYAL HOTS</option>
                <option value="536">CROWN ROYAL HOTS</option>
                <option value="537">ROBES ROYAL HOTS</option>
                <option value="538">STONE OF THE SWORD</option>
                <option value="539">CART LARGE</option>
                <option value="540">COG</option>
                <option value="541">CORBITA</option>
                <option value="542">KNARR</option>
                <option value="543">CARAVEL</option>
                <option value="544">RUDDER</option>
                <option value="545">SEAT</option>
                <option value="546">HULL PLANK</option>
                <option value="547">ANCHOR</option>
                <option value="548">STEERINGWHEEL</option>
                <option value="549">TACKLESMALL</option>
                <option value="550">TACKLE LARGE</option>
                <option value="551">TENON</option>
                <option value="552">MASTT ALL</option>
                <option value="553">STERN</option>
                <option value="554">SAIL TRIANGULAR</option>
                <option value="555">SAIL SQUARE</option>
                <option value="556">OAR</option>
                <option value="557">ROPE THICK</option>
                <option value="558">ROPE MOORING</option>
                <option value="559">ROPE THIN</option>
                <option value="560">KEEL PART</option>
                <option value="561">PEG WOOD</option>
                <option value="562">KEEL</option>
                <option value="563">RIG TRIANGULAR</option>
                <option value="564">RIG SQUARE</option>
                <option value="565">ROPE ANCHOR</option>
                <option value="566">DECKBOARD</option>
                <option value="567">BELAYING PIN</option>
                <option value="568">BOAT LOCK</option>
                <option value="569">DEAD MARLIN</option>
                <option value="570">DEAD SHARKBLUE</option>
                <option value="571">DEAD SHARKWHITE</option>
                <option value="572">DEAD OCTOPUS</option>
                <option value="573">DEAD SAILFISH</option>
                <option value="574">DEAD DORADO</option>
                <option value="575">DEAD TUNA</option>
                <option value="576">BARREL HUGE</option>
                <option value="577">BANNER</option>
                <option value="578">BANNER KINGDOM</option>
                <option value="579">FLAG KINGDOM</option>
                <option value="580">MARKET STALL</option>
                <option value="581">DREDGE</option>
                <option value="582">DREDGE LIP</option>
                <option value="583">CROWS NEST</option>
                <option value="584">RIG SPINNAKER</option>
                <option value="585">RIG SQUARE LARGE</option>
                <option value="586">RIG SQUARE YARD</option>
                <option value="587">RIG SQUARE TALL</option>
                <option value="588">MAST SMALL</option>
                <option value="589">MAST MEDIUM</option>
                <option value="590">MAST LARGE</option>
                <option value="591">SAIL SQUARE SMALL</option>
                <option value="592">MINE DOOR PLANKS</option>
                <option value="593">MINE DOOR STONE</option>
                <option value="594">MINE DOOR GOLD</option>
                <option value="595">MINE DOOR SILVER</option>
                <option value="596">MINE DOOR STEEL</option>
                <option value="597">SHEETSTEEL</option>
                <option value="598">SHEETSILVER</option>
                <option value="599">SHEETGOLD</option>
                <option value="600">SUMMERHAT</option>
                <option value="601">SHAKERORB</option>
                <option value="602">WANDSCULP TING</option>
                <option value="603">PORTALSTONE</option>
                <option value="604">PORTALRING</option>
                <option value="605">PORTALHOTS</option>
                <option value="606">PORTALMOLREHAN</option>
                <option value="607">PORTALJENN</option>
                <option value="608">STONEWELL</option>
                <option value="609">SPRINGSTEEL</option>
                <option value="610">TRAPSTICKS</option>
                <option value="611">TRAPPOLE</option>
                <option value="612">TRAPCORROSION</option>
                <option value="613">TRAPAXE</option>
                <option value="614">TRAPKNIFE</option>
                <option value="615">TRAPNET</option>
                <option value="616">TRAPSCYTHE</option>
                <option value="617">TRAPMAN</option>
                <option value="618">TRAPBOW</option>
                <option value="619">TRAPROPE</option>
                <option value="620">MIXEDGRASS</option>
                <option value="621">SADDLE</option>
                <option value="622">SADDLE LARGE</option>
                <option value="623">HORSESHOE</option>
                <option value="624">BRIDLE</option>
                <option value="625">GIRTH</option>
                <option value="626">STIRRUPS</option>
                <option value="627">BIT</option>
                <option value="628">REINS</option>
                <option value="629">SADDLE SEAT</option>
                <option value="630">SADDLE SEAT LARGE</option>
                <option value="631">HEAD STALL</option>
                <option value="632">YOKE</option>
                <option value="633">WAND TILE</option>
                <option value="634">DISH WATER</option>
                <option value="635">STONE FOUNTAIN 2</option>
                <option value="637">PORTAL FREEDOM</option>
                <option value="638">GUARD TOWER FREEDOM</option>
                <option value="639">MEDITATION RUG ONE</option>
                <option value="640">PUPPET FO</option>
                <option value="641">PUPPET MAGRANON</option>
                <option value="642">PUPPET VYNORA</option>
                <option value="643">PUPPET LIBILA</option>
                <option value="644">MEDITATION RUG TWO</option>
                <option value="645">MEDITATION RUG THREE</option>
                <option value="646">MEDITATION RUG FOUR</option>
                <option value="647">GROOMING BRUSH</option>
                <option value="648">PORTAL SHARD</option>
                <option value="649">LIGHT TOKEN</option>
                <option value="650">FARMER SSALVE</option>
                <option value="651">GIFTBOX</option>
                <option value="652">CHRIST MASTREE</option>
                <option value="653">FLASK GLASS</option>
                <option value="654">POTIONTRANSMUTATION</option>
                <option value="655">SNOWMAN</option>
                <option value="656">SIGN SHOP</option>
                <option value="657">STREET LAMPTORCH</option>
                <option value="658">STREET LAMPHANGING</option>
                <option value="659">STREET LAMPIMPERIAL</option>
                <option value="660">TORCHMETAL</option>
                <option value="661">HOPPER</option>
                <option value="662">BULKCONTAINER</option>
                <option value="663">SETTLEMENT DEED</option>
                <option value="664">CHEST NODECAY LARGE</option>
                <option value="665">CHEST NODECAY SMALL</option>
                <option value="666">SLEEP POWDER</option>
                <option value="667">TUNING FORK</option>
                <option value="668">ROD TRANSMUTATION</option>
                <option value="669">BULKITEM</option>
                <option value="670">TRASHBIN</option>
                <option value="671">SETTLEMENTMARKER</option>
                <option value="672">QUICKDECAYITEM</option>
                <option value="673">PERIMETERMARKER</option>
                <option value="674">LAMPHEADHANGING</option>
                <option value="675">LAMPHEADIMPERIAL</option>
                <option value="676">MISSIONRULER</option>
                <option value="677">SIGNGM</option>
                <option value="678">STONEFO</option>
                <option value="679">BUILDMARKER</option>
                <option value="680">STONELIB</option>
                <option value="681">FENCE LUMPS</option>
                <option value="682">DECLARATION INDEPENDENCE</option>
                <option value="683">VALREIITEM</option>
                <option value="684">LOWQL IRON</option>
                <option value="685">CRUDEKNIFE</option>
                <option value="686">PICK BLADESTONE</option>
                <option value="687">CRUDE PICKAXE</option>
                <option value="688">BRANCH</option>
                <option value="689">CRUDESHOVEL BLADE</option>
                <option value="690">CRUDESHOVEL</option>
                <option value="691">CRUDESHAFT</option>
                <option value="692">ADAMAN TINEBOULDER</option>
                <option value="693">ADAMAN TINE ORE</option>
                <option value="694">ADAMAN TINE LUMP</option>
                <option value="695">SCRAPADAMAN TINE</option>
                <option value="696">GLIMMERSTEELBOULDER</option>
                <option value="697">GLIMMERSTEEL ORE</option>
                <option value="698">GLIMMERSTEEL LUMP</option>
                <option value="699">SCRAPGLIMMERSTEEL</option>
                <option value="700">FIREWORKS</option>
                <option value="701">BRANDING IRON</option>
                <option value="702">LEATHER LUMPDING</option>
                <option value="703">CHAIN LUMPDING</option>
                <option value="704">CLOTH LUMPDING</option>
                <option value="705">SPEARLONG</option>
                <option value="706">HALBERD</option>
                <option value="707">SPEARSTEEL</option>
                <option value="708">HEADHALBERD</option>
                <option value="709">SPEARTIP</option>
                <option value="710">STAFFSTEEL</option>
                <option value="711">STAFF WOOD</option>
                <option value="712">SHRINE</option>
                <option value="713">PYLON</option>
                <option value="714">OBELISK</option>
                <option value="715">TEMPLE</option>
                <option value="716">SPIRITGATE</option>
                <option value="717">PILLAR</option>
                <option value="718">BELL HUGE</option>
                <option value="719">BELLSMALL</option>
                <option value="720">RESONATORSMALL</option>
                <option value="721">RESONATOR LARGE</option>
                <option value="722">BELLTOWER</option>
                <option value="723">BELLCOT</option>
                <option value="724">WEAPONSRACK</option>
                <option value="725">WEAPONSRACKPOLEARMS</option>
                <option value="726">DUELRING</option>
                <option value="727">DUELRINGSIDE</option>
                <option value="728">DUELRINGCORNER</option>
                <option value="729">CAKE</option>
                <option value="730">CAKESLICE</option>
                <option value="731">TREESTUMP</option>
                <option value="732">PORTALEPIC</option>
                <option value="733">PORTALEPIC HUGE</option>
                <option value="734">CLAPPERSMALL</option>
                <option value="735">CLAPPER LARGE</option>
                <option value="736">PILLARDECORATION</option>
                <option value="737">VALREIQUESTITEM</option>
                <option value="738">GARDENGNOME</option>
                <option value="739">PILLARHOTA</option>
                <option value="740">MEDALLIONHOTA</option>
                <option value="741">SPEEDSHRINEHOTA</option>
                <option value="742">STATUE HOTA</option>
                <option value="743">REED</option>
                <option value="744">REEDSEED</option>
                <option value="745">REEDFIBRE</option>
                <option value="746">RICE</option>
                <option value="747">PAPYRUSPRESS</option>
                <option value="748">PAPYRUSSHEET</option>
                <option value="749">REEDPEN</option>
                <option value="750">STRAWBERRYSEED</option>
                <option value="751">RULERRECHARGER</option>
                <option value="752">INKSAC</option>
                <option value="753">INK</option>
                <option value="754">RICECOOKED</option>
                <option value="755">KELP</option>
                <option value="756">THATCH</option>
                <option value="757">OIL LUMPREL</option>
                <option value="758">WEAPONSRACKBOWS</option>
                <option value="759">ARMOURSTAND</option>
                <option value="760">OUTPOST</option>
                <option value="761">BATTLECAMP</option>
                <option value="762">FORTIFICATION</option>
                <option value="763">SOURCE</option>
                <option value="764">SOURCESALT</option>
                <option value="765">SOURCECRYSTAL</option>
                <option value="766">SOURCEFOUNTAIN</option>
                <option value="767">SOURCESPRING</option>
                <option value="768">WINE LUMPRELSMALL</option>
                <option value="769">BRICKCLAY</option>
                <option value="770">SLATESHARD</option>
                <option value="771">SLATESLAB</option>
                <option value="772">SHEET COPPER</option>
                <option value="773">SHEET IRON</option>
                <option value="774">THATCHINGTOOL</option>
                <option value="775">STAIRS WOODENSIMPLE</option>
                <option value="776">BRICKPOTTERY</option>
                <option value="777">SHINGLECLAY</option>
                <option value="778">SHINGLEPOTTERY</option>
                <option value="779">CLOTH HOOD</option>
                <option value="780">FISHING RODUNSTRUNG</option>
                <option value="781">HANDMIRROR</option>
                <option value="782">CONCRETE</option>
                <option value="784">SHINGLESLATE</option>
                <option value="785">MARBLE SHARD</option>
                <option value="786">MARBLE BRICK</option>
                <option value="787">MARBLE SLAB</option>
                <option value="788">SMELTING POT</option>
                <option value="789">CLAYSMEL TINGPOT</option>
                <option value="790">SHINGLE WOOD</option>
                <option value="791">SANTAHAT</option>
                <option value="792">SACRIFICIALKNIFE</option>
                <option value="793">SACRIFICIALKNIFE BLADE</option>
                <option value="794">KEYHEAVENS</option>
                <option value="795">BLOODANGELS</option>
                <option value="796">SMOKESOL</option>
                <option value="797">SLIMEUTTACHA</option>
                <option value="798">TOMEMAGICRED</option>
                <option value="799">SCROLLBINDING</option>
                <option value="800">CHERRYWHITE</option>
                <option value="801">CHERRYRED</option>
                <option value="802">CHERRYGREEN</option>
                <option value="803">GIANTWALNUT</option>
                <option value="804">TOMEERUPTION</option>
                <option value="805">WANDOFTHESEAS</option>
                <option value="806">LIBRAMNIGHT</option>
                <option value="807">TOMEMAGICGREEN</option>
                <option value="808">TOMEMAGICBLACK</option>
                <option value="809">TOMEMAGICBLUE</option>
                <option value="810">TOMEMAGICWHITE</option>
                <option value="811">STATUE HORSE</option>
                <option value="812">FLOWERPOTCLAY</option>
                <option value="813">FLOWERPOTPOTTERY</option>
                <option value="814">FLOWERPOTYELLOW</option>
                <option value="815">FLOWERPOTBLUE</option>
                <option value="816">FLOWERPOTPURPLE</option>
                <option value="817">FLOWERPOTWHITE</option>
                <option value="818">FLOWERPOTORANGE</option>
                <option value="819">FLOWERPOTGREENISH</option>
                <option value="820">FLOWERPOTWHITEDOTTED</option>
                <option value="821">GRAVESTONE</option>
                <option value="822">GRAVESTONEBURIED</option>
                <option value="823">EQUIPMENTSLOT</option>
                <option value="824">INVENTORYGROUP</option>
                <option value="825">STAFFSAPPHIRE</option>
                <option value="826">STAFFRUBY</option>
                <option value="827">STAFFDIAMOND</option>
                <option value="828">STAFFOPAL</option>
                <option value="829">STAFFEMERALD</option>
                <option value="830">TEMPARROW</option>
                <option value="831">TA LUMPD</option>
                <option value="832">WALNUT</option>
                <option value="833">CHESTNUT</option>
                <option value="834">POTIONILLUSION</option>
                <option value="835">VILLAGEBOARD</option>
                <option value="836">POTIONAFFINITY</option>
                <option value="837">SERYLL LUMP</option>
                <option value="838">COPPERBRAZIERSTAND</option>
                <option value="839">COPPERBRAZIERBOWL</option>
                <option value="840">GOLD LARGEBRAZIERBOWL</option>
                <option value="841">COPPERBRAZIER</option>
                <option value="842">MARBLE BRAZIERPILLAR</option>
                <option value="843">NAMECHANGECERT</option>
                <option value="844">SNOW LANTERN</option>
                <option value="845">WATERMARKER</option>
                <option value="846">BLACKBEARRUG</option>
                <option value="847">BROWNBEARRUG</option>
                <option value="848">MOUNTAINLIONRUG</option>
                <option value="849">BLACKWOLFRUG</option>
                <option value="850">WAGON</option>
                <option value="851">CRATESMALL</option>
                <option value="852">CRATE LARGE</option>
                <option value="853">SHIPCARRIER</option>
                <option value="854">TUTORIALOBJECT</option>
                <option value="855">TUTORIALPORTAL</option>
                <option value="856">RICEPORRIDGE</option>
                <option value="857">RISOTTO</option>
                <option value="858">WINERICE</option>
                <option value="859">LARGECHAINLINK IRON</option>
                <option value="860">WOODBEAM</option>
                <option value="861">TENT</option>
                <option value="862">DEED STAKE</option>
                <option value="863">TENTEXPLORATION</option>
                <option value="864">TENTMILITARY</option>
                <option value="865">PAVILION</option>
                <option value="866">BLOOD</option>
                <option value="867">BONECOLLAR</option>
                <option value="868">SKULL</option>
                <option value="869">COLOSSUS OF VYNORA</option>
                <option value="870">COLOSSUS OF MAGRANON</option>
                <option value="871">POTIONWEAPONSMITHING</option>
                <option value="872">POTIONROPEMAKING</option>
                <option value="873">POTIONWATERWALKING</option>
                <option value="874">POTIONMINING</option>
                <option value="875">POTIONTAILORING</option>
                <option value="876">POTIONARMOURSMITHING</option>
                <option value="877">POTIONFLETCHING</option>
                <option value="878">POTIONBLACKSMITHING</option>
                <option value="879">POTIONLEATHERWORKING</option>
                <option value="880">POTIONSHIPBUILDING</option>
                <option value="881">POTIONSTONECUT TING</option>
                <option value="882">POTIONMASONRY</option>
                <option value="883">POTION WOODCUT TING</option>
                <option value="884">POTIONCARPENTRY</option>
                <option value="885">WOODENBEDSIDETABLE</option>
                <option value="886">POTIONACIDDAMAGE</option>
                <option value="887">POTIONFIREDAMAGE</option>
                <option value="888">POTIONFROSTDAMAGE</option>
                <option value="889">OPENFIREPLACE</option>
                <option value="890">CANOPYBED</option>
                <option value="891">WOODENBENCH</option>
                <option value="892">WARDROBE</option>
                <option value="893">WOODENCOFFER</option>
                <option value="894">ROYAL THRONE</option>
                <option value="895">WASHINGBOWL</option>
                <option value="896">TRIPODTABLESMALL</option>
                <option value="897">BRASSBAND</option>
                <option value="898">TURTLESHELL</option>
                <option value="899">TURTLESHIELD</option>
                <option value="900">CRABMEAT</option>
                <option value="901">RANGEPOLE</option>
                <option value="902">PROTRACTOR</option>
                <option value="903">DIOPTRA</option>
                <option value="904">SIGHT</option>
                <option value="905">STONEKEYSTONE</option>
                <option value="906">MARBLE KEYSTONE</option>
                <option value="907">COLOSSUS OF FO</option>
                <option value="908">SMALL CARPET</option>
                <option value="909">MEDIUMC ARPET</option>
                <option value="910">LARGE CARPET</option>
                <option value="911">HIGH BOOK SHELF</option>
                <option value="912">LOW BOOK SHELF</option>
                <option value="913">HIGH CHAIR 1</option>
                <option value="914">HIGH CHAIR 2</option>
                <option value="915">HIGH CHAIR 3</option>
                <option value="916">COLOSSUS OF LIBILA</option>
                <option value="917">IVY SEEDLING</option>
                <option value="918">GRAPE SEEDLING</option>
                <option value="919">IVY TRELLIS</option>
                <option value="920">GRAPE TRELLIS</option>
                <option value="921">WOOL</option>
                <option value="922">SPINNING WHEEL</option>
                <option value="923">LOUNGE CHAIR</option>
                <option value="924">ROYAL LOUNGECHAISE</option>
                <option value="925">WOOL YARN</option>
                <option value="926">CLOTH YARDWOOL</option>
                <option value="927">CUPBOARD</option>
                <option value="928">ROUNDMARBLE TABLE</option>
                <option value="929">RECTMARBLE TABLE</option>
                <option value="930">BUTTERFLY</option>
                <option value="931">SIEGE SHIELD</option>
                <option value="932">ARROW BALLISTA</option>
                <option value="933">BALLIST AMOUNT</option>
                <option value="934">PEWPEWDIE</option>
                <option value="935">ARROW HEAD BALLISTA</option>
                <option value="936">BALLISTA</option>
                <option value="937">TREBUCHET</option>
                <option value="938">BARRIER</option>
                <option value="939">ARCHERY TOWER</option>
                <option value="940">PEWPEWDIEACID</option>
                <option value="941">PEWPEWDIEFIRE</option>
                <option value="942">PEWPEWDIELIGHTNING</option>
                <option value="943">WOOL CAP</option>
                <option value="944">WOOL CAP YELLOW</option>
                <option value="945">WOOL CAP GREEN</option>
                <option value="946">WOOL CAP RED</option>
                <option value="947">WOOL CAP BLUE</option>
                <option value="948">COMMON WOOL HAT</option>
                <option value="949">COMMON WOOL HAT DARK</option>
                <option value="950">COMMON WOOL HAT BROWN</option>
                <option value="951">COMMON WOOL HAT GREEN</option>
                <option value="952">COMMON WOOL HAT RED</option>
                <option value="953">COMMON WOOL HAT BLUE</option>
                <option value="954">FORESTE SWOOLHAT</option>
                <option value="955">FORESTER SWOOL HAT GREEN</option>
                <option value="956">FORESTER SWOOL HAT DARK</option>
                <option value="957">FORESTER SWOOL HAT BLUE</option>
                <option value="958">FORESTER SWOOL HAT RED</option>
                <option value="959">BROWNBEARHELM</option>
                <option value="960">LEATHERHAT0</option>
                <option value="961">SQUIRE WOOL CAP</option>
                <option value="962">SQUIRE WOOL CAPGREEN</option>
                <option value="963">SQUIRE WOOL CAPBLUE</option>
                <option value="964">SQUIRE WOOL CAPBLACK</option>
                <option value="965">SQUIRE WOOL CAPRED</option>
                <option value="966">SQUIRE WOOL CAPYELLOW</option>
                <option value="967">GARDENGNOMEGREEN</option>
                <option value="968">PEWPEWDIEICE</option>
                <option value="969">SUPPLY DEPOT 1</option>
                <option value="970">SUPPLY DEPOT 2</option>
                <option value="971">SUPPLY DEPOT 3</option>
                <option value="972">YULEGOAT</option>
                <option value="973">MASK ENLIGHTENDED</option>
                <option value="974">MASK RAVAGER</option>
                <option value="975">MASK PALE</option>
                <option value="976">MASK SHADOW</option>
                <option value="977">MASK CHALLENGE</option>
                <option value="978">MASK ISLES</option>
                <option value="979">GOLD GREAT HELMHORNED</option>
                <option value="980">OPEN PLUMED HELM</option>
                <option value="981">GOLD CHALLENGE STATUE</option>
                <option value="982">SILVER CHALLENGE STATUE</option>
                <option value="983">BRONZE CHALLENGE STATUE</option>
                <option value="984">MARBLE CHALLENGE STATUE</option>
                <option value="985">HOT ANECKLACE</option>
                <option value="986">STAFF OF LAND</option>
                <option value="987">TAPESTRY STAND</option>
                <option value="988">TAPESTRY PATTERN 1</option>
                <option value="989">TAPESTRY PATTERN 2</option>
                <option value="990">TAPESTRY PATTERN 3</option>
                <option value="991">TAPESTRY MOTIF CAVALRY</option>
                <option value="992">TAPESTRY MOTIF FESTIVITIES</option>
                <option value="993">TAPESTRY MOTIF BATTLE KYARA</option>
                <option value="994">TAPESTRY FAELDRAY</option>
                <option value="995">TREASURE CHEST</option>
                <option value="996">GUARD TOWER NEUTRAL</option>
                <option value="997">VALEN TINES</option>
                <option value="998">HELMET CAVALIER</option>
                <option value="999">TALLKING DOM BANNER</option>
                <option value="1000">OWNER SHIP PAPERS</option>
                <option value="1001">MARBLE PLANTER</option>
                <option value="1002">MARBLE PLANTERYELLOW</option>
                <option value="1003">MARBLE PLANTERBLUE</option>
                <option value="1004">MARBLE PLANTERPURPLE</option>
                <option value="1005">MARBLE PLANTERWHITE</option>
                <option value="1006">MARBLE PLANTERORANGE</option>
                <option value="1007">MARBLE PLANTERGREENISH</option>
                <option value="1008">MARBLE PLANTERWHITEDOTTED</option>
                <option value="1009">RODE RUPTION</option>
                <option value="1010">AXE BLADE STONE</option>
                <option value="1011">CRUDE AXE</option>
                <option value="1012">MILK SHEEP</option>
                <option value="1013">MILK BISON</option>
                <option value="1014">GOBLIN LEADER HAT</option>
                <option value="1015">TROLL KING HAT</option>
                <option value="1017">ROSE SEEDLING</option>
                <option value="1018">ROSE TRELLIS</option>
                <option value="1019">AMPHORA SMALL CLAY</option>
                <option value="1020">AMPHORA SMALL POTTERY</option>
                <option value="1021">AMPHORA LARGECLAY</option>
                <option value="1022">AMPHORA LARGEPOTTERY</option>
                <option value="1023">KILN</option>
                <option value="1024">CONCH</option>
              </select>
            </div>
            <div class="form-group">
              <label>Quality</label>
              <input type="text" class="form-control" id="txtItemQuality" placeholder="Item quality" />
            </div>
            <div class="form-group">
              <label>Rarity</label>
              <select class="form-control" id="txtItemRarity">
                <option value="0">Common</option>
                <option value="1">Rare</option>
                <option value="2">Supreme</option>
                <option value="3">Fantastic</option>
              </select>
            </div>
            <div class="form-group">
              <label>Amount</label>
              <input type="number" class="form-control" id="txtItemAmount" value="1" placeholder="How many to give" />
            </div>
            <div class="form-group">
              <label>Creator</label>
              <input type="text" class="form-control" id="txtItemCreator" value="<?php echo $userData['username']; ?>" placeholder="Creator of the item" />
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Add!</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <input type="hidden" id="txtWurmID" value="<?php echo $_GET['id']; ?>" />
  
  <script src="<?php echo $application["rootPath"]; ?>assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

  <script>
    $(document).ready(function() {
      var wurmID = $('#txtWurmID').val();
      populate();

      function populate() {
        $.ajax({
          type: 'POST',
          url: 'view.php',
          data: {wurmID: wurmID},
          dataType: 'json',
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              /**
               * Left col
               */
              $('#playerImage').prop('src', response.image);
              $('#playerName').html(response.NAME);

              switch(response.POWER) {
                case '0':
                  $('#playerPower').html('Power: Player');
                  break;
                case '1':
                  $('#playerPower').html('Power: HERO');
                  break;
                case '2':
                  $('#playerPower').html('Power: GM');
                  break;
                case '3':
                  $('#playerPower').html('Power: High God');
                  break;
                case '4':
                  $('#playerPower').html('Power: Arch GM');
                  break;
                case '5':
                  $('#playerPower').html('Power: Implementor');
                  break;
                default:
                  $('#playerPower').html('Power: Unknown kingdom');
                  break;
              }

              $('#playerIP').html(response.IPADDRESS);
              $('#playerFirstSeen').html(response.CREATIONDATE);
              $('#playerLastSeen').html(response.LASTLOGOUT);
              $('#playerPlayTime').html(response.PLAYINGTIME);
              if(response.BANNED == 0) {
                $('#playerIsBanned').html('False');
                $('#btnBanUnBan').addClass('btn-danger');
                $('#btnBanUnBan').html('Ban');
                $('#btnBanUnBan').attr('data-do', "1");
              }
              else {
                $('#playerIsBanned').html('True');
                $('#playerBanTime').html(response.BANEXPIRY);
                $('#liPlayerBanTime').show();
                $('#playerBanReason').html(response.BANREASON);
                $('#liPlayerBanReason').show();
                $('#btnBanUnBan').addClass('btn-success');
                $('#btnBanUnBan').html('Unban');
                $('#btnBanUnBan').attr('data-do', "0");
              }

              if(response.MUTED == 0) {
                $('#playerMuted').html('False');
                $('#btnMuteUnmute').addClass('btn-danger');
                $('#btnMuteUnmute').html('Mute');
                $('#btnMuteUnmute').attr('data-do', "1");
              }
              else {
                $('#playerMuted').html('True');
                $('#playerMuteTime').html(response.MUTEEXPIRY);
                $('#liPlayerMuteTime').show();
                $('#playerMuteReason').html(response.MUTEREASON);
                $('#liPlayerMuteReason').show();
                $('#btnMuteUnmute').addClass('btn-success');
                $('#btnMuteUnmute').html('Unmute');
                $('#btnMuteUnmute').attr('data-do', "0");
              }

              /**
               * Right col
               */
              $('#playerMoney').html(response.MONEY);
              $('#playerEmail').html(response.EMAIL);

              if(response.CHEATED == 0) {
                $('#playerCheated').html('False');
              }
              else {
                $('#playerCheated').html('True: ' + response.CHEATREASON);
              }

              $('#playerMuteCount').html(response.MUTETIMES);

              switch(response.KINGDOM) {
                case '0':
                  $('#playerKingdom').html('No kingdom');
                  break;
                case '1':
                  $('#playerKingdom').html('Jenn-Kellon');
                  break;
                case '2':
                  $('#playerKingdom').html('Mol-Rehan');
                  break;
                case '3':
                  $('#playerKingdom').html('Horde of the Summoned');
                  break;
                case '4':
                  $('#playerKingdom').html('Freedom Isles');
                  break;
                default:
                  $('#playerKingdom').html('Unknown kingdom');
                  break;
              }

            }
            else {
              swal("Error!", "Could not load this player", "error");
            }

            $('#1stDiv').show();
            $('#2ndDiv').show();
            $('#loader-0').hide();
            $('#loader-1').hide();

          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#userList').show();
            $('#loader').hide();
          }
        });
      
      }

      $('#txtItemID').multiselect({
        enableFiltering: true,
        buttonContainer: '<div class="btn-group full-width" />',
        numberDisplayed: 7,
        enableCaseInsensitiveFiltering: true,
        templates: {
          button: '<button type="button" class="multiselect dropdown-toggle full-width" data-toggle="dropdown"><span class="multiselect-selected-text"></span> <b class="caret"></b></button>'
        }
      });

      $('#btnBanUnBan').on('click', function(e) {
        e.preventDefault();

        var action = $('#btnBanUnBan').data('do');

        if(action == 1) {
          $('#modalBan').modal('show');
        }
        else {
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {doing: "banFunction", action: action, wurmID: wurmID},
            dataType: 'json',
            beforeSend: function() {
              $('#btnBanUnBan').prop('disabled', true);
              $('#btnBanUnBan').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
            },
            success: function(response) {
              if(response.error) {
                switch(response.error.message) {
                  case 'Missing database':
                    swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                    break;
                  default:
                    swal("Error", response.error.message, "error");
                    break;
                }
              }
              else if(response.success) {
                swal("Unbanned!", "This player has been unbanned!", "success");
                $('#playerIsBanned').html('False');
                $('#btnBanUnBan').addClass('btn-danger');
                $('#btnBanUnBan').html('Ban');
                $('#btnBanUnBan').attr('data-do', "1");
                $('#liPlayerBanTime').hide();
                $('#liPlayerBanReason').hide();
              }
              else {
                swal("Failed to ban!", "We could not proccess this request at this time.", "error");
              }

              $('#btnBanUnBan').prop('disabled', false);

            },
            error: function(error) {
              console.log(error);
              swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
              $('#btnBanUnBan').prop('disabled', false);
            }
          });
        }

      });
      $('#formBanPlayer').on('submit', function(e) {
        e.preventDefault();

        var banDays = $('#txtBanDays').val();
        var banReason = $('#txtBanReason').val();

        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "banFunction", action: $('#btnBanUnBan').data('do'), wurmID: wurmID, banDays: banDays, banReason: banReason},
          dataType: 'json',
          beforeSend: function() {
            $('#modalBanLoader').show();
            $('#formBanPlayer').hide();
          },
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              if($('#modalBan').modal('hide')) {
                swal("Banned!", "This player has been banned!", "success");
                $('#playerIsBanned').html('True');
                $('#playerBanTime').html(response.BANEXPIRY);
                $('#liPlayerBanTime').show();
                $('#playerBanReason').html(banReason);
                $('#liPlayerBanReason').show();

                $('#btnBanUnBan').removeClass('btn-danger');
                $('#btnBanUnBan').addClass('btn-success');
                $('#btnBanUnBan').html('Unban');
                $('#btnBanUnBan').attr('data-do', "0");
              }

            }
            else {
              swal("Failed to ban!", "We could not proccess this request at this time.", "error");
            }

          },
          error: function(error) {
            console.log(error);
            $('#modalBan').modal('hide');
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });

      });

      $('#btnMuteUnmute').on('click', function(e) {
        e.preventDefault();

        var action = $('#btnMuteUnmute').data('do');

        if(action == 1) {
          $('#modalMute').modal('show');
        }
        else {
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {doing: "muteFunction", action: action, wurmID: wurmID},
            dataType: 'json',
            beforeSend: function() {
              $('#btnMuteUnmute').prop('disabled', true);
              $('#btnMuteUnmute').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
            },
            success: function(response) {

              if(response.error) {
                switch(response.error.message) {
                  case 'Missing database':
                    swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                    break;
                  default:
                    swal("Error", response.error.message, "error");
                    break;
                }
              }
              else if(response.success) {
                swal("Unmuted!", "This player has been unmuted!", "success");
                $('#playerMuted').html('False');
                $('#btnMuteUnmute').addClass('btn-danger');
                $('#btnMuteUnmute').html('Mute');
                $('#btnMuteUnmute').attr('data-do', '1');
                $('#liPlayerMuteTime').hide();
                $('#liPlayerMuteReason').hide();
              }
              else {
                swal("Failed to unmute!", "We could not proccess this request at this time.", "error");
              }

              $('#btnMuteUnmute').prop('disabled', false);

            },
            error: function(error) {
              console.log(error);
              swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
              $('#btnMuteUnmute').prop('disabled', false);
            }
          });
        }

      });
      $('#formMutePlayer').on('submit', function(e) {
        e.preventDefault();

        var muteHours = $('#txtMuteHours').val();
        var muteReason = $('#txtMuteReason').val();

        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "muteFunction", action: $('#btnMuteUnmute').data('do'), wurmID: wurmID, muteHours: muteHours, muteReason: muteReason},
          dataType: 'json',
          beforeSend: function() {
            $('#modalMuteLoader').show();
            $('#formMutePlayer').hide();
          },
          success: function(response) {

            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              if($('#modalMute').modal('hide')) {
                swal("Muted!", "This player has been muted!", "success");
                $('#playerMuted').html('True');
                $('#playerMuteTime').html(response.MUTEEXPIRY);
                $('#liPlayerMuteTime').show();
                $('#playerMuteReason').html(muteReason);
                $('#liPlayerMuteReason').show();

                $('#btnMuteUnmute').removeClass('btn-danger');
                $('#btnMuteUnmute').addClass('btn-success');
                $('#btnMuteUnmute').html('Unmute');
                $('#btnMuteUnmute').attr('data-do', "0");
              }

            }
            else {
              swal("Failed to mute!", "We could not proccess this request at this time.", "error");
            }

          },
          error: function(error) {
            console.log(error);
            $('#modalMute').modal('hide');
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
          }
        });

      });

      $('#btnChangePower').on('click', function(e) {
        swal({
          title: 'Change player power',
          text: '<select id="txtPower" class="form-control"><option value="0">Player</option><option value="1">HERO</option><option value="2">GM</option><option value="3">High God</option><option value="4">Arch GM</option><option value="5">Implementor</option></select>',
          html: true,
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonText: 'Change',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          closeOnConfirm: false
        },
        function(isConfirm) {
          if(isConfirm) {
            var tempPower = $('#txtPower').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changePower", power: tempPower, wurmID: wurmID},
              dataType: 'json',
              success: function(response) {
                if(response.error) {
                  switch(response.error.message) {
                    case 'Missing database':
                      swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                      break;
                    default:
                      swal("Error", response.error.message, "error");
                      break;
                  }
                }
                else if(response.success) {
                  var textPower = "";
                  switch(tempPower) {
                    case '0':
                      textPower = 'Player';
                      break;
                    case '1':
                      textPower = 'HERO';
                      break;
                    case '2':
                      textPower = 'GM';
                      break;
                    case '3':
                      textPower = 'High God';
                      break;
                    case '4':
                      textPower = 'Arch GM';
                      break;
                    case '5':
                      textPower = 'Implementor';
                      break;
                    default:
                      textPower = 'Unknown power';
                      break;
                  }
                  swal('Power changed!', 'The powers for this player has been changed to [ ' + textPower + ' ]!', 'success');
                  $('#playerPower').html('Power: ' + textPower);
                }
                else {
                  swal('Failed to change!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
          }
        });

      });

      $('#btnAddMoney').on('click', function(e) {
        e.preventDefault();

        swal({
          title: 'Add money',
          text: 'Enter the amount of money to add to players bank in IRON coins ( 10000 = 1 silver, 1000000 = 1 gold):',
          type: 'input',
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          inputPlaceholder: 'Enter money in IRON coins'
        }, function(money) {
          if (money === false || money === '') {
            swal.showInputError('You need to write something!');
            return false
          }
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "addMoney", money: money, wurmID: wurmID},
              dataType: 'json',
              success: function(response) {
                if(response.error) {
                  switch(response.error.message) {
                    case 'Missing database':
                      swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                      break;
                    default:
                      swal("Error", response.error.message, "error");
                      break;
                  }
                }
                else if(response.success) {
                  swal('Money added!', '[ ' + response.money + ' ] was added to the players bank!', 'success');
                  $('#playerMoney').html(response.totalMoney);
                }
                else {
                  swal('Failed to add!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
        });

      });

      $('#btnChangeEmail').on('click', function(e) {
        e.preventDefault();

        swal({
          title: 'Add email',
          text: 'Enter a new email address for this user:',
          type: 'input',
          showCancelButton: true,
          closeOnConfirm: false,
          showLoaderOnConfirm: true,
          inputPlaceholder: 'Email address'
        }, function(email) {
          if (email === false || email === '') {
            swal.showInputError('You need to write something!');
            return false
          }
            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeEmail", email: email, wurmID: wurmID},
              dataType: 'json',
              success: function(response) {
                if(response.error) {
                  switch(response.error.message) {
                    case 'Missing database':
                      swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                      break;
                    default:
                      swal("Error", response.error.message, "error");
                      break;
                  }
                }
                else if(response.success) {
                  swal('Changed!', 'The players new email is [ ' + email + ' ]!', 'success');
                  $('#playerEmail').html(email);
                }
                else {
                  swal('Failed to change!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
        });

      });

      $('#btnChangeKingdom').on('click', function(e) {
        swal({
          title: 'Change player kingdom',
          text: '<select id="txtKingdom" class="form-control"><option value="0">No kingdom</option><option value="1">Jenn-Kellon</option><option value="2">Mol-Rehan</option><option value="3">Horde of the Summoned</option><option value="4">Freedom Isles</option></select>',
          html: true,
          showCancelButton: true,
          showConfirmButton: true,
          confirmButtonText: 'Change',
          cancelButtonText: 'Cancel',
          showLoaderOnConfirm: true,
          closeOnConfirm: false
        },
        function(isConfirm) {
          if(isConfirm) {
            var tempKingdom = $('#txtKingdom').val();

            $.ajax({
              type: 'POST',
              url: 'process.php',
              data: {doing: "changeKingdom", kingdom: tempKingdom, wurmID: wurmID},
              dataType: 'json',
              success: function(response) {
                console.log(response);
                if(response.error) {
                  switch(response.error.message) {
                    case 'Missing database':
                      swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                      break;
                    default:
                      swal("Error", response.error.message, "error");
                      break;
                  }
                }
                else if(response.success) {
                  var textKingdom = "";
                  switch(tempKingdom) {
                    case '0':
                      textKingdom = 'No kingdom';
                      break;
                    case '1':
                      textKingdom = 'Jenn-Kellon';
                      break;
                    case '2':
                      textKingdom = 'Mol-Rehan';
                      break;
                    case '3':
                      textKingdom = 'Horde of the Summoned';
                      break;
                    case '4':
                      textKingdom = 'Freedom Isles';
                      break;
                    default:
                      textKingdom = 'Unknown kingdom';
                      break;
                  }
                  swal('Kingdom changed!', 'The players kingdom has been changed to [ ' + textKingdom + ' ]!', 'success');
                  $('#playerKingdom').html(textKingdom);
                }
                else {
                  swal('Failed to change!', 'We could not proccess this request at this time.', 'error');
                }

              },
              error: function(error) {
                console.log(error);
                swal('Failed', 'It looks like we couldn\'t proccess your request at this time. Please try again later.', 'error');
              }
            });
          }
        });

      });

      $('#btnRefreshInventory').on('click', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "getInventory", playerID: wurmID},
          dataType: 'json',
          beforeSend: function() {
            $('#btnRefreshInventory').prop('disabled', true);
            $('#btnRefreshInventory').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
          },
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else {
              console.log(response);
              var html = '';
              for(var i = 0; i < response.length; i++)
              {
                var rarity = '';
                switch(response[i].RARITY) {
                  case '0':
                    rarity = 'Normal';
                    break;
                  case '1':
                    rarity = '<font color="#3D79AB">Rare</font>';
                    break;
                  case '2':
                    rarity = '<font color="#00FFFF">Supreme</font>';
                    break;
                  case '3':
                    rarity = '<font color="#F809FC">Fantastic</font>';
                    break;
                  default:
                    rarity = 'Unknown';
                    break;
                }
                html += '<tr><td><input type="checkbox" /></td><td>' + response[i].NAME + '</td><td>' + rarity + '</td><td>' + response[i].ORIGINALQUALITYLEVEL + '</td><td>' + response[i].QUALITYLEVEL + '</td></tr>';
              }
              $('#tableInventory tbody').html(html);

              $('#invFirstLoad').hide();
              $('#tableInventory').show();
            }

            $('#btnRefreshInventory').prop('disabled', false);
            $('#btnRefreshInventory').html('Refresh inventory');


          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#btnRefreshInventory').prop('disabled', false);
            $('#btnRefreshInventory').html('Refresh inventory');
          }
        });

      });

      $('#formAddItem').on('submit', function(e) {
        e.preventDefault();

        var itemIDs = [];
        $('#txtItemID option:selected').map(function(a, item){itemIDs.push(item.value);});
        var itemQuality = $('#txtItemQuality').val();
        var itemRarity = $('#txtItemRarity').val();
        var itemAmount = $('#txtItemAmount').val();
        var itemCreator = $('#txtItemCreator').val();
        
        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "addItem", wurmID: wurmID, itemTemplateID: JSON.stringify(itemIDs), itemQuality: itemQuality, itemRarity: itemRarity, creator: itemCreator, itemAmount: itemAmount},
          dataType: 'json',
          beforeSend: function() {
            $('#modalAddItemLoader').show();
            $('#formAddItem').hide();
          },
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              if($('#modalAddItem').modal('hide')) {
                swal("Added!", "The item has been added to the players inventory!", "success");
              }

            }
            else {
              swal("Failed to add!", "We could not proccess this request at this time.", "error");
            }

            $('#modalAddItemLoader').hide();
            $('#formAddItem').show();

          },
          error: function(error) {
            console.log(error);
            $('#modalAddItem').modal('hide');
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#modalAddItemLoader').hide();
            $('#formAddItem').show();
          }
        });
      });

      $('#btnRefreshSkills').on('click', function(e) {
        e.preventDefault();
        $.ajax({
          type: 'POST',
          url: 'process.php',
          data: {doing: "getSkills", playerID: wurmID},
          dataType: 'json',
          beforeSend: function() {
            $('#btnRefreshSkills').prop('disabled', true);
            $('#btnRefreshSkills').html('<div class="la-ball-fall" style="width:inherit;"><div></div><div></div><div></div></div>');
          },
          success: function(response) {
            if(response.error) {
              switch(response.error.message) {
                case 'Missing database':
                  swal("Missing Databases", "Couldn't find the player and item database. Please double check your config file.", "error");
                  break;
                default:
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else {
              var html = '';
              for(var i = 0; i < response.length; i++)
              {
                html += '<tr><td>' + response[i].NAME + '</td><td>' + response[i].MINVALUE + '</td><td>' + response[i].VALUE + '</td></tr>';
              }
              $('#tableSkills tbody').html(html);

              $('#skillsFirstLoad').hide();
              $('#tableSkills').show();
            }

            $('#btnRefreshSkills').prop('disabled', false);
            $('#btnRefreshSkills').html('Refresh skills');


          },
          error: function(error) {
            console.log(error);
            swal("Failed", "It looks like we couldn't proccess your request at this time. Please try again later.", "error");
            $('#btnRefreshSkills').prop('disabled', false);
            $('#btnRefreshSkills').html('Refresh skills');
          }
        });

      });

    });
  </script>

<?php
require("../../footer.php");
?>