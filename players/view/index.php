<?php
$page = "player";
$rootPath = "../..";
require("../../header.php");
?>
  <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css" />
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
                <option value="1">backpack, leather</option>
                <option value="2">satchel, cotton</option>
                <option value="3">small axe, birchwood</option>
                <option value="4">shield, iron</option>
                <option value="5">potion</option>
                <option value="6">green apple</option>
                <option value="7">hatchet, birchwood</option>
                <option value="8">carving knife, iron</option>
                <option value="9">log</option>
                <option value="20">pickaxe, iron</option>
                <option value="21">longsword, iron</option>
                <option value="22">plank, birchwood</option>
                <option value="23">shaft, birchwood</option>
                <option value="24">saw, iron</option>
                <option value="25">shovel, birchwood</option>
                <option value="26">dirt</option>
                <option value="27">rake, birchwood</option>
                <option value="28">barley</option>
                <option value="29">wheat</option>
                <option value="30">rye</option>
                <option value="31">oat</option>
                <option value="32">corn</option>
                <option value="33">pumpkin</option>
                <option value="34">pumpkin seed</option>
                <option value="35">potato</option>
                <option value="36">kindling, birchwood</option>
                <option value="37">campfire, birchwood</option>
                <option value="38">ore, iron</option>
                <option value="39">ore, gold</option>
                <option value="40">ore, silver</option>
                <option value="41">ore, lead</option>
                <option value="42">ore, zinc</option>
                <option value="43">ore, copper</option>
                <option value="44">lump, gold</option>
                <option value="45">lump, silver</option>
                <option value="46">lump, iron</option>
                <option value="47">lump, copper</option>
                <option value="48">lump, zinc</option>
                <option value="49">lump, lead</option>
                <option value="50">coin copper</option>
                <option value="51">coin iron</option>
                <option value="52">coin silver</option>
                <option value="53">coin gold</option>
                <option value="54">five coin, copper</option>
                <option value="55">five coin, iron</option>
                <option value="56">five coin, silver</option>
                <option value="57">five coin, gold</option>
                <option value="58">twenty coin, copper</option>
                <option value="59">twenty coin, iron</option>
                <option value="60">twenty coin, silver</option>
                <option value="61">twenty coin, gold</option>
                <option value="62">hammer, iron</option>
                <option value="63">mallet, birchwood</option>
                <option value="64">small anvil, iron</option>
                <option value="65">cheese drill, birchwood</option>
                <option value="66">cheese</option>
                <option value="67">goat cheese</option>
                <option value="68">feta cheese</option>
                <option value="69">buffalo cheese</option>
                <option value="70">honey</option>
                <option value="71">hide</option>
                <option value="72">leather</option>
                <option value="73">lye</option>
                <option value="74">pile</option>
                <option value="75">frying pan, iron</option>
                <option value="76">pottery jar</option>
                <option value="77">pottery bowl</option>
                <option value="78">pottery flask</option>
                <option value="79">water skin, leather</option>
                <option value="80">short sword, iron</option>
                <option value="81">two handed sword, iron</option>
                <option value="82">small shield, birchwood</option>
                <option value="83">small metal shield, iron</option>
                <option value="84">shield, birchwood</option>
                <option value="85">large shield, birchwood</option>
                <option value="86">large shield, iron</option>
                <option value="87">huge axe, birchwood</option>
                <option value="88">huge axe head, iron</option>
                <option value="89">small axe head, iron</option>
                <option value="90">axe, birchwood</option>
                <option value="91">axe head, iron</option>
                <option value="92">meat</option>
                <option value="93">butchering knife, iron</option>
                <option value="94">fine fishing rod, birchwood</option>
                <option value="95">fine fishing hook, iron</option>
                <option value="96">fishing hook, birchwood</option>
                <option value="97">stone chisel, iron</option>
                <option value="98">scabbard, leather</option>
                <option value="99">handle, birchwood</option>
                <option value="100">strip of leather</option>
                <option value="101">leather wound handle, birchwood</option>
                <option value="102">leather belt</option>
                <option value="103">leather glove</option>
                <option value="104">leather jacket</option>
                <option value="105">leather boot</option>
                <option value="106">leather sleeve</option>
                <option value="107">leather cap</option>
                <option value="108">leather pants</option>
                <option value="109">cloth glove, cotton</option>
                <option value="110">cloth shirt, cotton</option>
                <option value="111">cloth sleeve, cotton</option>
                <option value="112">cloth jacket, cotton</option>
                <option value="113">cloth pants, cotton</option>
                <option value="114">cloth shoe, cotton</option>
                <option value="115">studded leather sleeve</option>
                <option value="116">studded leather boot</option>
                <option value="117">studded leather cap</option>
                <option value="118">studded leather pants</option>
                <option value="119">studded leather glove</option>
                <option value="120">studded leather jacket</option>
                <option value="121">shovel blade, iron</option>
                <option value="122">shovel blade, birchwood</option>
                <option value="123">pickaxe head, iron</option>
                <option value="124">rake blade, iron</option>
                <option value="125">butchering knife blade, iron</option>
                <option value="126">carving knife blade, iron</option>
                <option value="127">hammer head, iron</option>
                <option value="128">water</option>
                <option value="129">cooked meat</option>
                <option value="130">clay</option>
                <option value="131">rivets, iron</option>
                <option value="132">stone brick</option>
                <option value="133">candle</option>
                <option value="134">hazelnuts</option>
                <option value="135">lantern, iron</option>
                <option value="136">oil lamp, brass</option>
                <option value="138">torch, birchwood</option>
                <option value="139">spindle, birchwood</option>
                <option value="140">animal fat</option>
                <option value="141">ash</option>
                <option value="142">milk</option>
                <option value="143">steel and flint</option>
                <option value="144">cotton</option>
                <option value="145">cotton seed</option>
                <option value="146">rock shards</option>
                <option value="147">short sword blade, iron</option>
                <option value="148">long sword blade, iron</option>
                <option value="149">huge sword blade, iron</option>
                <option value="150">fine fishing line, iron</option>
                <option value="151">fishing line, birchwood</option>
                <option value="152">fishing rod, birchwood</option>
                <option value="153">tar</option>
                <option value="154">chisel blade, iron</option>
                <option value="156">mallet head, birchwood</option>
                <option value="157">pike</option>
                <option value="158">smallmouth bass</option>
                <option value="159">herring</option>
                <option value="160">catfish</option>
                <option value="161">snook</option>
                <option value="162">roach</option>
                <option value="163">perch</option>
                <option value="164">carp</option>
                <option value="165">brook trout</option>
                <option value="166">writ of ownership</option>
                <option value="167">door lock, iron</option>
                <option value="168">key, iron</option>
                <option value="169">wood scrap, birchwood</option>
                <option value="170">scrap, iron</option>
                <option value="171">rags, cotton</option>
                <option value="172">leather pieces</option>
                <option value="173">pig food</option>
                <option value="174">wand of teleportation, birchwood</option>
                <option value="175">gift</option>
                <option value="176">ebony wand</option>
                <option value="177">pile of items</option>
                <option value="178">oven</option>
                <option value="179">unfinished item</option>
                <option value="180">forge</option>
                <option value="181">clay jar</option>
                <option value="182">clay bowl</option>
                <option value="183">clay flask</option>
                <option value="184">large chest, birchwood</option>
                <option value="185">large anvil, iron</option>
                <option value="186">small cart, birchwood</option>
                <option value="187">small wheel, birchwood</option>
                <option value="188">ribbon, iron</option>
                <option value="189">small barrel, birchwood</option>
                <option value="190">large barrel, birchwood</option>
                <option value="191">small wheel axle, birchwood</option>
                <option value="192">small chest, birchwood</option>
                <option value="193">small padlock, iron</option>
                <option value="194">large padlock, iron</option>
                <option value="195">scrap, copper</option>
                <option value="196">scrap, gold</option>
                <option value="197">scrap, silver</option>
                <option value="198">scrap, zinc</option>
                <option value="199">scrap, lead</option>
                <option value="200">dough</option>
                <option value="201">flour</option>
                <option value="202">grindstone</option>
                <option value="203">bread</option>
                <option value="204">charcoal</option>
                <option value="205">lump, steel</option>
                <option value="206">scrap, steel</option>
                <option value="207">ore, tin</option>
                <option value="208">pointing sign, birchwood</option>
                <option value="209">large sign, birchwood</option>
                <option value="210">small sign, birchwood</option>
                <option value="211">size ten village deed</option>
                <option value="212">bale, cotton</option>
                <option value="213">square piece of cloth, cotton</option>
                <option value="214">string of cloth, cotton</option>
                <option value="215">needle, iron</option>
                <option value="216">needle, copper</option>
                <option value="217">large nails, iron</option>
                <option value="218">small nails, iron</option>
                <option value="219">pliers, iron</option>
                <option value="220">lump, tin</option>
                <option value="221">lump, brass</option>
                <option value="222">scrap, tin</option>
                <option value="223">lump, bronze</option>
                <option value="224">scrap, bronze</option>
                <option value="225">scrap, brass</option>
                <option value="226">floor loom, birchwood</option>
                <option value="227">statuette</option>
                <option value="228">candelabra</option>
                <option value="229">chain</option>
                <option value="230">necklace</option>
                <option value="231">bracelet</option>
                <option value="232">ball</option>
                <option value="233">pendulum</option>
                <option value="234">size five homestead deed</option>
                <option value="236">settlement token</option>
                <option value="237">size five village deed</option>
                <option value="238">size fifteen village deed</option>
                <option value="239">size twenty village deed</option>
                <option value="242">size fifty village deed</option>
                <option value="244">size hundred village deed</option>
                <option value="245">size twohundred village deed</option>
                <option value="246">green mushroom</option>
                <option value="247">black mushroom</option>
                <option value="248">brown mushroom</option>
                <option value="249">yellow mushroom</option>
                <option value="250">blue mushroom</option>
                <option value="251">red mushroom</option>
                <option value="252">gate lock, iron</option>
                <option value="253">size ten homestead deed</option>
                <option value="254">size twenty homestead deed</option>
                <option value="257">spoon</option>
                <option value="258">knife</option>
                <option value="259">fork</option>
                <option value="260">round table, birchwood</option>
                <option value="261">stool, birchwood</option>
                <option value="262">small square table, birchwood</option>
                <option value="263">chair, birchwood</option>
                <option value="264">large dining table, birchwood</option>
                <option value="265">armchair, birchwood</option>
                <option value="266">sprout, birchwood</option>
                <option value="267">sickle, birchwood</option>
                <option value="268">scythe, birchwood</option>
                <option value="269">sickle blade, iron</option>
                <option value="270">scythe blade, iron</option>
                <option value="271">yoyo, birchwood</option>
                <option value="272">corpse</option>
                <option value="273">steel glove</option>
                <option value="274">chain boot</option>
                <option value="275">chain pants</option>
                <option value="276">chain jacket</option>
                <option value="277">chain sleeve</option>
                <option value="278">chain gauntlet</option>
                <option value="279">chain coif</option>
                <option value="280">plate sabaton</option>
                <option value="281">plate leggings</option>
                <option value="282">breast plate</option>
                <option value="283">plate vambrace</option>
                <option value="284">plate gauntlet</option>
                <option value="285">basinet helm</option>
                <option value="286">great helm</option>
                <option value="287">open helm</option>
                <option value="288">armour chains</option>
                <option value="289">small raft, birchwood</option>
                <option value="290">large maul, iron</option>
                <option value="291">small maul, iron</option>
                <option value="292">maul, iron</option>
                <option value="293">large maul head, iron</option>
                <option value="294">small maul head, iron</option>
                <option value="295">maul head, iron</option>
                <option value="296">whetstone</option>
                <option value="297">ring</option>
                <option value="298">heap of sand</option>
                <option value="299">trader contract</option>
                <option value="300">personal merchant contract</option>
                <option value="301">cornucopia</option>
                <option value="302">fur</option>
                <option value="303">tooth</option>
                <option value="304">horn</option>
                <option value="305">paw</option>
                <option value="306">hoof</option>
                <option value="307">tail</option>
                <option value="308">eye</option>
                <option value="309">bladder</option>
                <option value="310">gland</option>
                <option value="311">twisted horn</option>
                <option value="312">long horn</option>
                <option value="313">pelt</option>
                <option value="314">huge shod club, birchwood</option>
                <option value="315">ivory wand</option>
                <option value="316">wemp plants</option>
                <option value="317">wemp seed</option>
                <option value="318">wemp fibre</option>
                <option value="319">rope</option>
                <option value="320">rope tool, birchwood</option>
                <option value="321">practice doll, birchwood</option>
                <option value="322">altar, birchwood</option>
                <option value="323">altar</option>
                <option value="324">altar, gold</option>
                <option value="325">altar, silver</option>
                <option value="326">bowl</option>
                <option value="327">Altar of Three</option>
                <option value="328">Huge bone altar</option>
                <option value="329">Rod of Beguiling, gold</option>
                <option value="330">Crown of Might, gold</option>
                <option value="331">Charm of Fo, gold</option>
                <option value="332">Eye of Vynora</option>
                <option value="333">Ear of Vynora</option>
                <option value="334">Mouth of Vynora</option>
                <option value="335">Finger of Fo, silver</option>
                <option value="336">Sword of Magranon, steel</option>
                <option value="337">Hammer of Magranon, bronze</option>
                <option value="338">Scale of Libila, iron</option>
                <option value="339">Orb of Doom</option>
                <option value="340">Sceptre of Ascension, steel</option>
                <option value="341">key, copper</option>
                <option value="342">key mould, clay</option>
                <option value="343">key form, pottery</option>
                <option value="344">marker</option>
                <option value="345">stew</option>
                <option value="346">casserole</option>
                <option value="347">meal</option>
                <option value="348">gulasch</option>
                <option value="349">salt</option>
                <option value="350">sauce pan, iron</option>
                <option value="351">cauldron, iron</option>
                <option value="352">soup</option>
                <option value="353">lovage</option>
                <option value="354">sage</option>
                <option value="355">onion</option>
                <option value="356">garlic</option>
                <option value="357">oregano</option>
                <option value="358">parsley</option>
                <option value="359">basil</option>
                <option value="360">thyme</option>
                <option value="361">belladonna</option>
                <option value="362">strawberries</option>
                <option value="363">rosemary</option>
                <option value="364">blueberry</option>
                <option value="365">nettles</option>
                <option value="366">sassafras</option>
                <option value="367">lingonberry</option>
                <option value="368">meat fillet</option>
                <option value="369">fish fillet</option>
                <option value="370">Crazy diamond</option>
                <option value="371">drake hide, leather</option>
                <option value="372">scale, leather</option>
                <option value="373">porridge</option>
                <option value="374">emerald</option>
                <option value="375">star emerald</option>
                <option value="376">ruby</option>
                <option value="377">star ruby</option>
                <option value="378">opal</option>
                <option value="379">black opal</option>
                <option value="380">diamond</option>
                <option value="381">star diamond</option>
                <option value="382">sapphire</option>
                <option value="383">star sapphire</option>
                <option value="384">guard tower</option>
                <option value="385">felled tree</option>
                <option value="386">unfinished item</option>
                <option value="387">illusionary item</option>
                <option value="388">file, iron</option>
                <option value="389">file blade, iron</option>
                <option value="390">awl, iron</option>
                <option value="391">awl blade, iron</option>
                <option value="392">leather knife, iron</option>
                <option value="393">leather knife blade, iron</option>
                <option value="394">scissors, iron</option>
                <option value="395">scissor blade, iron</option>
                <option value="396">clay shaper, birchwood</option>
                <option value="397">spatula, birchwood</option>
                <option value="398">statue of nymph</option>
                <option value="399">statue of demon</option>
                <option value="400">statue of dog</option>
                <option value="401">statue of troll</option>
                <option value="402">statue of boy</option>
                <option value="403">statue of girl</option>
                <option value="404">bench</option>
                <option value="405">decorative fountain</option>
                <option value="406">slab</option>
                <option value="407">coffin</option>
                <option value="408">fountain</option>
                <option value="409">cherries</option>
                <option value="410">lemon</option>
                <option value="411">blue grapes</option>
                <option value="412">olives</option>
                <option value="413">fruitpress, birchwood</option>
                <option value="414">green grapes</option>
                <option value="415">maple syrup</option>
                <option value="416">maple sap</option>
                <option value="417">fruit juice</option>
                <option value="418">olive oil</option>
                <option value="419">red wine</option>
                <option value="420">white wine</option>
                <option value="421">small bucket, birchwood</option>
                <option value="422">camellia</option>
                <option value="423">oleander</option>
                <option value="424">lavender flower</option>
                <option value="425">tea</option>
                <option value="426">rose flower</option>
                <option value="427">lemonade</option>
                <option value="428">jam</option>
                <option value="429">support beam, birchwood</option>
                <option value="430">guard tower</option>
                <option value="431">black dye</option>
                <option value="432">white dye</option>
                <option value="433">red dye</option>
                <option value="434">blue dye</option>
                <option value="435">green dye</option>
                <option value="436">acorns</option>
                <option value="437">tannin</option>
                <option value="438">dye</option>
                <option value="439">cochineal</option>
                <option value="440">woad</option>
                <option value="441">metal brush, birchwood</option>
                <option value="442">large delicious julbord, birchwood</option>
                <option value="443">bag of keeping, leather</option>
                <option value="444">wires, iron</option>
                <option value="445">small catapult, birchwood</option>
                <option value="446">flint</option>
                <option value="447">short bow, birchwood</option>
                <option value="448">bow, birchwood</option>
                <option value="449">long bow, birchwood</option>
                <option value="451">hunting arrow head, iron</option>
                <option value="452">war arrow head, iron</option>
                <option value="454">arrow shaft, birchwood</option>
                <option value="455">hunting arrow, birchwood</option>
                <option value="456">war arrow, birchwood</option>
                <option value="457">bow string</option>
                <option value="458">archery target, birchwood</option>
                <option value="459">short bow, birchwood</option>
                <option value="460">bow, birchwood</option>
                <option value="461">long bow, birchwood</option>
                <option value="462">quiver, leather</option>
                <option value="463">lock picks, iron</option>
                <option value="464">egg</option>
                <option value="465">huge egg</option>
                <option value="466">easter egg</option>
                <option value="467">peat</option>
                <option value="468">drake hide sleeve, leather</option>
                <option value="469">drake hide boot, leather</option>
                <option value="470">drake hide cap, leather</option>
                <option value="471">drake hide pants, leather</option>
                <option value="472">drake hide glove, leather</option>
                <option value="473">drake hide jacket, leather</option>
                <option value="474">dragon scale boot, leather</option>
                <option value="475">dragon scale pants, leather</option>
                <option value="476">dragon scale jacket, leather</option>
                <option value="477">dragon scale sleeve, leather</option>
                <option value="478">dragon scale glove, leather</option>
                <option value="479">moss</option>
                <option value="480">compass, brass</option>
                <option value="481">healing cover</option>
                <option value="482">head board, birchwood</option>
                <option value="483">bed frame, birchwood</option>
                <option value="484">bed, birchwood</option>
                <option value="485">foot board, birchwood</option>
                <option value="486">sheet, cotton</option>
                <option value="487">flag, birchwood</option>
                <option value="488">sandwich</option>
                <option value="489">spyglass, brass</option>
                <option value="490">small rowing boat, birchwood</option>
                <option value="491">small sailing boat, birchwood</option>
                <option value="492">mortar, clay</option>
                <option value="493">trowel, iron</option>
                <option value="494">trowel blade, iron</option>
                <option value="495">floor boards, birchwood</option>
                <option value="496">lamp, iron</option>
                <option value="497">lamp head, iron</option>
                <option value="498">bouquet of yellow flowers</option>
                <option value="499">bouquet of orange-red flowers</option>
                <option value="500">bouquet of purple flowers</option>
                <option value="501">bouquet of white flowers</option>
                <option value="502">bouquet of blue flowers</option>
                <option value="503">bouquet of greenish-yellow flowers</option>
                <option value="504">bouquet of white-dotted flowers</option>
                <option value="505">statuette of Fo</option>
                <option value="506">statuette of Libila</option>
                <option value="507">statuette of Magranon</option>
                <option value="508">statuette of Vynora</option>
                <option value="509">resurrection stone</option>
                <option value="510">spirit house, birchwood</option>
                <option value="511">spirit cottage</option>
                <option value="512">spirit mansion, birchwood</option>
                <option value="513">spirit castle</option>
                <option value="514">whip of One, leather</option>
                <option value="515">crown of One</option>
                <option value="516">toolbelt, leather</option>
                <option value="517">hooks, iron</option>
                <option value="518">colossus</option>
                <option value="519">colossus brick</option>
                <option value="520">firemarker</option>
                <option value="521">lair, birchwood</option>
                <option value="522">carved pumpkin</option>
                <option value="523">hatchet head, iron</option>
                <option value="524">farwalker twig, birchwood</option>
                <option value="525">farwalker stone</option>
                <option value="526">granite wand</option>
                <option value="527">farwalker amulet, silver</option>
                <option value="528">guard tower</option>
                <option value="529">royal sceptre, gold</option>
                <option value="530">royal crown, gold</option>
                <option value="531">royal robes, cotton</option>
                <option value="532">staff of the office, birchwood</option>
                <option value="533">circlet, silver</option>
                <option value="534">chancellor cape, cotton</option>
                <option value="535">black claw</option>
                <option value="536">cage crown, steel</option>
                <option value="537">thorn robes, cotton</option>
                <option value="538">stone of the sword</option>
                <option value="539">large cart, birchwood</option>
                <option value="540">cog, birchwood</option>
                <option value="541">corbita, birchwood</option>
                <option value="542">knarr, birchwood</option>
                <option value="543">caravel, birchwood</option>
                <option value="544">rudder, birchwood</option>
                <option value="545">seat, birchwood</option>
                <option value="546">hull plank, birchwood</option>
                <option value="547">anchor, lead</option>
                <option value="548">ship helm, birchwood</option>
                <option value="549">small tackle, birchwood</option>
                <option value="550">large tackle, birchwood</option>
                <option value="551">tenon, birchwood</option>
                <option value="552">tall mast, birchwood</option>
                <option value="553">stern, birchwood</option>
                <option value="554">triangular sail, cotton</option>
                <option value="555">square sail, cotton</option>
                <option value="556">oar, birchwood</option>
                <option value="557">thick rope</option>
                <option value="558">mooring rope</option>
                <option value="559">cordage rope</option>
                <option value="560">keel section, birchwood</option>
                <option value="561">peg, birchwood</option>
                <option value="562">keel, birchwood</option>
                <option value="563">triangular rig, birchwood</option>
                <option value="564">square rig, birchwood</option>
                <option value="565">mooring anchor</option>
                <option value="566">deck board, birchwood</option>
                <option value="567">belaying pin, birchwood</option>
                <option value="568">boat lock, iron</option>
                <option value="569">marlin</option>
                <option value="570">blue shark</option>
                <option value="571">white shark</option>
                <option value="572">octopus</option>
                <option value="573">sailfish</option>
                <option value="574">dorado</option>
                <option value="575">tuna</option>
                <option value="576">huge tub, birchwood</option>
                <option value="577">banner, birchwood</option>
                <option value="578">kingdom banner, birchwood</option>
                <option value="579">kingdom flag, birchwood</option>
                <option value="580">market stall, birchwood</option>
                <option value="581">dredge, birchwood</option>
                <option value="582">dredge scraping lip, steel</option>
                <option value="583">crows nest, birchwood</option>
                <option value="584">spinnaker rig, birchwood</option>
                <option value="585">large square rig, birchwood</option>
                <option value="586">square yard rig, birchwood</option>
                <option value="587">tall square rig, birchwood</option>
                <option value="588">small mast, birchwood</option>
                <option value="589">medium mast, birchwood</option>
                <option value="590">large mast, birchwood</option>
                <option value="591">small square sail, cotton</option>
                <option value="592">mine door, birchwood</option>
                <option value="593">mine door</option>
                <option value="594">mine door, gold</option>
                <option value="595">mine door, silver</option>
                <option value="596">mine door, steel</option>
                <option value="597">sheet, steel</option>
                <option value="598">sheet, silver</option>
                <option value="599">sheet, gold</option>
                <option value="600">summer hat, silver</option>
                <option value="601">shaker orb</option>
                <option value="602">sculpting wand, birchwood</option>
                <option value="603">monolith portal</option>
                <option value="604">ring portal</option>
                <option value="605">desolate portal</option>
                <option value="606">flame portal</option>
                <option value="607">portal</option>
                <option value="608">well</option>
                <option value="609">spring, steel</option>
                <option value="610">stick trap, birchwood</option>
                <option value="611">pole trap, birchwood</option>
                <option value="612">corrosive traps, pottery</option>
                <option value="613">axe trap, birchwood</option>
                <option value="614">knife trap, birchwood</option>
                <option value="615">net trap, cotton</option>
                <option value="616">scythe trap</option>
                <option value="617">man trap, steel</option>
                <option value="618">bow trap, birchwood</option>
                <option value="619">rope trap</option>
                <option value="620">mixed grass</option>
                <option value="621">saddle, leather</option>
                <option value="622">large saddle, leather</option>
                <option value="623">horse shoe, iron</option>
                <option value="624">bridle, leather</option>
                <option value="625">girth, leather</option>
                <option value="626">stirrups, leather</option>
                <option value="627">mouth bit, iron</option>
                <option value="628">reins, leather</option>
                <option value="629">saddle seat, leather</option>
                <option value="630">large saddle seat, leather</option>
                <option value="631">headstall, leather</option>
                <option value="632">yoke, birchwood</option>
                <option value="633">brittle wand, cedarwood</option>
                <option value="634">dishwater</option>
                <option value="635">ornate fountain</option>
                <option value="636">heart</option>
                <option value="637">freedom stones</option>
                <option value="638">guard tower</option>
                <option value="639">meditation rug, cotton</option>
                <option value="640">Fo puppet, cotton</option>
                <option value="641">Magranon puppet, cotton</option>
                <option value="642">Vynora puppet, cotton</option>
                <option value="643">Libila puppet, cotton</option>
                <option value="644">fine meditation rug, cotton</option>
                <option value="645">beautiful meditation rug, cotton</option>
                <option value="646">exquisite meditation rug, cotton</option>
                <option value="647">grooming brush, birchwood</option>
                <option value="649">light token (lit)</option>
                <option value="650">farmer's salve</option>
                <option value="651">gift box, birchwood</option>
                <option value="652">christmas tree, pinewood</option>
                <option value="653">glass flask</option>
                <option value="654">transmutation liquid</option>
                <option value="655">snowman</option>
                <option value="656">shop sign, birchwood</option>
                <option value="657">torch lamp, iron</option>
                <option value="658">hanging lamp, iron</option>
                <option value="659">imperial street lamp, iron</option>
                <option value="660">metal torch, iron</option>
                <option value="661">food storage bin, birchwood</option>
                <option value="662">bulk storage bin, birchwood</option>
                <option value="663">settlement form</option>
                <option value="664">large magical chest, birchwood</option>
                <option value="665">small magical chest, birchwood</option>
                <option value="666">sleep powder, wheat</option>
                <option value="667">tuning fork of metal detection, silver</option>
                <option value="668">Rod of Transmutation</option>
                <option value="669">bulk item</option>
                <option value="670">trash heap, birchwood</option>
                <option value="671">Deed border</option>
                <option value="672">decayitem, pinewood</option>
                <option value="673">Perimeter</option>
                <option value="674">hanging lamp head, iron</option>
                <option value="675">imperial lamp head, iron</option>
                <option value="676">mission ruler, birchwood</option>
                <option value="677">small sign, birchwood</option>
                <option value="678">Fo obelisk</option>
                <option value="679">Construction marker, birchwood</option>
                <option value="680">Libila stone</option>
                <option value="681">fence bars, iron</option>
                <option value="682">declaration of independence</option>
                <option value="683">Wild Eye</option>
                <option value="684">rock, iron</option>
                <option value="685">crude knife</option>
                <option value="686">crude pickaxe head</option>
                <option value="687">crude pickaxe</option>
                <option value="688">branch, birchwood</option>
                <option value="689">crude shovel blade</option>
                <option value="690">crude shovel, birchwood</option>
                <option value="691">crude shaft, birchwood</option>
                <option value="692">boulder, adamantine</option>
                <option value="693">ore, adamantine</option>
                <option value="694">lump, adamantine</option>
                <option value="695">scrap, adamantine</option>
                <option value="696">boulder, glimmersteel</option>
                <option value="697">ore, glimmersteel</option>
                <option value="698">limp, glimmersteel</option>
                <option value="699">scrap, glimmersteel</option>
                <option value="700">fireworks, birchwood</option>
                <option value="701">branding iron</option>
                <option value="702">leather barding</option>
                <option value="703">chain barding, iron</option>
                <option value="704">cloth barding, cotton</option>
                <option value="705">long spear, birchwood</option>
                <option value="706">halberd, iron</option>
                <option value="707">spear, steel</option>
                <option value="708">huge halberd head, iron</option>
                <option value="709">spear tip, iron</option>
                <option value="710">staff, steel</option>
                <option value="711">staff, birchwood</option>
                <option value="712">shrine</option>
                <option value="713">pylon</option>
                <option value="714">obelisk</option>
                <option value="715">temple</option>
                <option value="716">spirit gate</option>
                <option value="717">foundation pillar</option>
                <option value="718">huge bell, bronze</option>
                <option value="719">small bell, brass</option>
                <option value="720">small resonator, brass</option>
                <option value="721">large bell resonator, bronze</option>
                <option value="722">bell tower, birchwood</option>
                <option value="723">bell cot, birchwood</option>
                <option value="724">weapons rack, birchwood</option>
                <option value="725">polearms rack, birchwood</option>
                <option value="726">ring center</option>
                <option value="727">duelling ring</option>
                <option value="728">ring corner</option>
                <option value="729">cake</option>
                <option value="730">cake slice</option>
                <option value="731">tree stump</option>
                <option value="732">epic portal</option>
                <option value="733">huge epic portal</option>
                <option value="734">tiny clapper, iron</option>
                <option value="735">large clapper, iron</option>
                <option value="736">pillar</option>
                <option value="737">Valrei mission item</option>
                <option value="738">garden gnome, clay</option>
                <option value="739">Hota pillar (lit)</option>
                <option value="740">medallion, gold</option>
                <option value="741">shrine of the rush</option>
                <option value="742">hota statue, gold</option>
                <option value="743">reed plants</option>
                <option value="744">reed seed</option>
                <option value="745">reed fibre</option>
                <option value="746">rice</option>
                <option value="747">press, birchwood</option>
                <option value="748">papyrus sheet</option>
                <option value="749">reed pen</option>
                <option value="750">strawberry seeds</option>
                <option value="751">mission ruler recharge, birchwood</option>
                <option value="752">ink sac</option>
                <option value="753">black ink</option>
                <option value="754">cooked rice</option>
                <option value="755">kelp</option>
                <option value="756">thatch</option>
                <option value="757">huge oil barrel, birchwood</option>
                <option value="758">bow rack, birchwood</option>
                <option value="759">armour stand, birchwood</option>
                <option value="760">outpost, birchwood</option>
                <option value="761">battle camp, birchwood</option>
                <option value="762">fortification, birchwood</option>
                <option value="763">source</option>
                <option value="764">source salt</option>
                <option value="765">source crystal</option>
                <option value="766">source fountain</option>
                <option value="767">source spring</option>
                <option value="768">small wine barrel, birchwood</option>
                <option value="769">clay brick</option>
                <option value="770">shards, slate</option>
                <option value="771">slate slab</option>
                <option value="772">sheet, copper</option>
                <option value="773">sheet, iron</option>
                <option value="774">leggat, birchwood</option>
                <option value="775">staircase, birchwood</option>
                <option value="776">pottery brick</option>
                <option value="777">clay shingle</option>
                <option value="778">pottery shingle</option>
                <option value="779">cloth hood, cotton</option>
                <option value="780">unstrung fishing rod, birchwood</option>
                <option value="781">hand mirror, silver</option>
                <option value="782">concrete, clay</option>
                <option value="784">slate shingle</option>
                <option value="785">shards, marble</option>
                <option value="786">marble brick</option>
                <option value="787">marble slab</option>
                <option value="788">smelting pot, pottery</option>
                <option value="789">clay smelting pot</option>
                <option value="790">wood shingle, birchwood</option>
                <option value="791">soft cap, cotton</option>
                <option value="792">sacrificial knife, silver</option>
                <option value="793">sacrificial knife blade, silver</option>
                <option value="794">key of the heavens, gold</option>
                <option value="795">blood of the angels (lit)</option>
                <option value="796">smoke from sol</option>
                <option value="797">uttacha slime</option>
                <option value="798">red tome of magic</option>
                <option value="799">scroll of binding</option>
                <option value="800">white cherry</option>
                <option value="801">red cherry</option>
                <option value="802">green cherry</option>
                <option value="803">giant walnut</option>
                <option value="804">tome of incineration</option>
                <option value="805">wand of the seas, oakenwood</option>
                <option value="806">libram of the night</option>
                <option value="807">green tome of magic</option>
                <option value="808">black tome of magic</option>
                <option value="809">blue tome of magic</option>
                <option value="810">white tome of magic</option>
                <option value="811">statue of horse</option>
                <option value="812">clay flowerpot</option>
                <option value="813">pottery flowerpot</option>
                <option value="814">yellow flowerpot, pottery</option>
                <option value="815">blue flowerpot, pottery</option>
                <option value="816">purple flowerpot, pottery</option>
                <option value="817">white flowerpot, pottery</option>
                <option value="818">orange-red flowerpot, pottery</option>
                <option value="819">greenish-yellow flowerpot, pottery</option>
                <option value="820">white-dotted flowerpot, pottery</option>
                <option value="821">gravestone</option>
                <option value="822">gravestone</option>
                <option value="823">equipmentSlot</option>
                <option value="824">group</option>
                <option value="825">sapphire staff, birchwood</option>
                <option value="826">Ruby staff, birchwood</option>
                <option value="827">diamond staff, birchwood</option>
                <option value="828">opal staff, birchwood</option>
                <option value="829">emerald staff, birchwood</option>
                <option value="830">fragile arrow</option>
                <option value="831">kingdom tabard, cotton</option>
                <option value="832">walnut</option>
                <option value="833">chestnut</option>
                <option value="834">yellow potion</option>
                <option value="835">village recruitment board, birchwood</option>
                <option value="836">brown potion</option>
                <option value="837">lump, seryll</option>
                <option value="838">brazier stand, copper</option>
                <option value="839">brazier bowl, copper</option>
                <option value="840">large brazier bowl, gold</option>
                <option value="841">small brazier, copper</option>
                <option value="842">marble brazier pillar</option>
                <option value="843">name change certificate</option>
                <option value="844">snow lantern</option>
                <option value="845">water marker</option>
                <option value="846">black bear rug</option>
                <option value="847">brown bear rug</option>
                <option value="848">mountain lion rug</option>
                <option value="849">black wolf rug</option>
                <option value="850">wagon, birchwood</option>
                <option value="851">small crate, birchwood</option>
                <option value="852">large crate, birchwood</option>
                <option value="853">ship transporter, birchwood</option>
                <option value="854">sign</option>
                <option value="855">steel portal, glimmersteel</option>
                <option value="856">rice porridge</option>
                <option value="857">risotto</option>
                <option value="858">rice wine</option>
                <option value="859">large chain link, iron</option>
                <option value="860">wooden beam, birchwood</option>
                <option value="861">tent, cotton</option>
                <option value="862">deed stake, birchwood</option>
                <option value="863">explorer tent, cotton</option>
                <option value="864">military tent, cotton</option>
                <option value="865">pavilion, cotton</option>
                <option value="866">blood</option>
                <option value="867">strange bone</option>
                <option value="868">skull</option>
                <option value="869">Colossus of Vynora</option>
                <option value="870">Colossus of Magranon</option>
                <option value="871">oil of the weapon smith</option>
                <option value="872">potion of the rope maker</option>
                <option value="873">potion of water walking</option>
                <option value="874">potion of mining</option>
                <option value="875">ointment of tailoring</option>
                <option value="876">oil of the armour smith</option>
                <option value="877">fletching potion</option>
                <option value="878">oil of the blacksmith</option>
                <option value="879">potion of leatherworking</option>
                <option value="880">potion of shipbuilding</option>
                <option value="881">ointment of stonecutting</option>
                <option value="882">ointment of masonry</option>
                <option value="883">potion of woodcutting</option>
                <option value="884">potion of carpentry</option>
                <option value="885">small bedside table, birchwood</option>
                <option value="886">potion of acid</option>
                <option value="887">salve of fire</option>
                <option value="888">salve of frost</option>
                <option value="889">open fireplace</option>
                <option value="890">canopy bed</option>
                <option value="891">bench, birchwood</option>
                <option value="892">wardrobe, birchwood</option>
                <option value="893">coffer, birchwood</option>
                <option value="894">royal throne, birchwood</option>
                <option value="895">washing bowl, brass</option>
                <option value="896">small tripod table, birchwood</option>
                <option value="897">brass ribbon</option>
                <option value="898">small tortoise shell</option>
                <option value="899">small tortoise shield</option>
                <option value="900">meat</option>
                <option value="901">range pole, birchwood</option>
                <option value="902">protractor, brass</option>
                <option value="903">dioptra, bronze</option>
                <option value="904">sight, bronze</option>
                <option value="905">stone keystone</option>
                <option value="906">marble keystone</option>
                <option value="907">Colossus of Fo</option>
                <option value="908">small colourful carpet, cotton</option>
                <option value="909">colourful carpet, cotton</option>
                <option value="910">large colourful carpet, cotton</option>
                <option value="911">high bookshelf, birchwood</option>
                <option value="912">low bookshelf, birchwood</option>
                <option value="913">fine high chair, birchwood</option>
                <option value="914">high chair, birchwood</option>
                <option value="915">paupers high chair, birchwood</option>
                <option value="916">Colossus of Libila</option>
                <option value="917">ivy seedling</option>
                <option value="918">grape seedling</option>
                <option value="919">ivy trellis</option>
                <option value="920">grape trellis, grapewood</option>
                <option value="921">wool</option>
                <option value="922">spinning wheel, birchwood</option>
                <option value="923">lounge chair, birchwood</option>
                <option value="924">royal lounge chaise, birchwood</option>
                <option value="925">yarn, wool</option>
                <option value="926">square piece of wool cloth</option>
                <option value="927">cupboard, birchwood</option>
                <option value="928">round marble table</option>
                <option value="929">rectangular marble table</option>
                <option value="931">siege shield</option>
                <option value="932">ballista dart, birchwood</option>
                <option value="933">machine mount, birchwood</option>
                <option value="934">strange device, birchwood</option>
                <option value="935">ballista dart head</option>
                <option value="936">ballista, birchwood</option>
                <option value="937">trebuchet, birchwood</option>
                <option value="938">spike barrier</option>
                <option value="939">archery tower, birchwood</option>
                <option value="940">acid turret, birchwood</option>
                <option value="941">fire turret, birchwood</option>
                <option value="942">lightning turret, birchwood</option>
                <option value="943">peasant wool cap</option>
                <option value="944">yellow peasant wool cap</option>
                <option value="945">green peasant wool cap</option>
                <option value="946">red peasant wool cap</option>
                <option value="947">blue peasant wool cap</option>
                <option value="948">common wool hat</option>
                <option value="949">dark common wool hat</option>
                <option value="950">brown common wool hat</option>
                <option value="951">green common wool hat</option>
                <option value="952">red common wool hat</option>
                <option value="953">blue common wool hat</option>
                <option value="954">foresters wool hat</option>
                <option value="955">green foresters wool hat</option>
                <option value="956">dark foresters wool hat</option>
                <option value="957">blue foresters wool hat</option>
                <option value="958">red foresters wool hat</option>
                <option value="959">brown bear helm, leather</option>
                <option value="960">leather adventurer hat</option>
                <option value="961">squire wool cap</option>
                <option value="962">green squire wool cap</option>
                <option value="963">blue squire wool cap</option>
                <option value="964">black squire wool cap</option>
                <option value="965">red squire wool cap</option>
                <option value="966">yellow squire wool cap</option>
                <option value="967">garden gnome, clay</option>
                <option value="968">frost turret, birchwood</option>
                <option value="969">supply depot</option>
                <option value="970">supply depot</option>
                <option value="971">supply depot</option>
                <option value="972">yule goat, straw</option>
                <option value="973">mask of the enlightended, leather</option>
                <option value="974">mask of the ravager, leather</option>
                <option value="975">pale mask, pottery</option>
                <option value="976">mask of the shadow, leather</option>
                <option value="977">mask of the challenge, silver</option>
                <option value="978">mask of the isles, pottery</option>
                <option value="979">horned helmet of gold, steel</option>
                <option value="980">plumed helm of the hunt, steel</option>
                <option value="981">challenge statue, gold</option>
                <option value="982">challenge statue, silver</option>
                <option value="983">challenge statue, bronze</option>
                <option value="984">challenge statue, marble</option>
                <option value="985">hota necklace, silver</option>
                <option value="986">staff of land, steel</option>
                <option value="987">tapestry stand, birchwood</option>
                <option value="988">green tapestry, wool</option>
                <option value="989">beige tapestry, wool</option>
                <option value="990">orange tapestry, wool</option>
                <option value="991">cavalry motif tapestry, wool</option>
                <option value="992">festivities motif tapestry, wool</option>
                <option value="993">battle of Kyara tapestry, wool</option>
                <option value="994">tapestry of Faeldray, wool</option>
                <option value="995">large treasure chest, birchwood</option>
                <option value="996">neutral guard tower</option>
                <option value="997">valentines, pottery</option>
                <option value="998">cavalier helmet, steel</option>
                <option value="999">tall kingdom banner, birchwood</option>
                <option value="1000">ownership papers</option>
                <option value="1001">marble planter</option>
                <option value="1002">yellow planter, marble</option>
                <option value="1003">blue planter, marble</option>
                <option value="1004">purple planter, marble</option>
                <option value="1005">white planter, marble</option>
                <option value="1006">orange-red planter, marble</option>
                <option value="1007">greenish-yellow planter, marble</option>
                <option value="1008">white-dotted planter, marble</option>
                <option value="1009">rod of eruption</option>
                <option value="1010">crude axe head</option>
                <option value="1011">crude axe</option>
                <option value="1012">milk</option>
                <option value="1013">milk</option>
                <option value="1014">goblin war bonnet, leather</option>
                <option value="1015">crown of the troll king, leather</option>
                <option value="1016">Stone of Soulfall</option>
                <option value="1017">rose seedling</option>
                <option value="1018">rose trellis, rosewood</option>
                <option value="1019">small clay amphora</option>
                <option value="1020">small pottery amphora</option>
                <option value="1021">large clay amphora</option>
                <option value="1022">large pottery amphora</option>
                <option value="1023">kiln</option>
                <option value="1024">conch</option>
                <option value="1025">birdcage, brass</option>
                <option value="1026">unstable source rift</option>
                <option value="1027">steel wand</option>
                <option value="1028">smelter</option>
                <option value="1029">halter rope</option>
                <option value="1030">sword display, birchwood</option>
                <option value="1031">axe display, birchwood</option>
                <option value="1032">yule reindeer, straw</option>
                <option value="1033">rift stone</option>
                <option value="1034">rift stone</option>
                <option value="1035">rift stone</option>
                <option value="1036">rift stone</option>
                <option value="1037">rift crystal</option>
                <option value="1038">rift crystal</option>
                <option value="1039">rift crystal</option>
                <option value="1040">rift crystal</option>
                <option value="1041">plant</option>
                <option value="1042">plant</option>
                <option value="1043">plant</option>
                <option value="1044">plant</option>
                <option value="1045">rift altar</option>
                <option value="1046">rift device</option>
                <option value="1047">rift device</option>
                <option value="1048">rift device</option>
                <option value="1049">small shoulder pad, cotton</option>
                <option value="1050">double shoulder pad, cotton</option>
                <option value="1051">curved shoulder pad, cotton</option>
                <option value="1052">triple shoulder pad, leather</option>
                <option value="1053">right elaborate shoulder pad, leather</option>
                <option value="1054">exquisite shoulder pad, leather</option>
                <option value="1055">right basic shoulder pad, iron</option>
                <option value="1056">right shielding shoulder pad, iron</option>
                <option value="1057">right stylish shoulder pad, gold</option>
                <option value="1058">right layered shoulder pad, steel</option>
                <option value="1059">chain shoulder pad</option>
                <option value="1060">crafted shoulder pad</option>
                <option value="1061">boar shoulder pad</option>
                <option value="1062">ribboned shoulder pad</option>
                <option value="1063">skull shoulder pad</option>
                <option value="1064">human skull shoulder pad</option>
                <option value="1065">dragon shoulder pad, steel</option>
                <option value="1066">left elaborate shoulder pad, leather</option>
                <option value="1067">green cloth tunic, cotton</option>
                <option value="1068">black belted vest, cotton</option>
                <option value="1069">red cloth tunic, cotton</option>
                <option value="1070">brown striped breeches, cotton</option>
                <option value="1071">patchwork pants, wool</option>
                <option value="1072">black cloth pants, cotton</option>
                <option value="1073">green cloth pants, cotton</option>
                <option value="1074">green cloth sleeve, cotton</option>
                <option value="1075">red cloth sleeve, cotton</option>
                <option value="1076">socketed ring, seryll</option>
                <option value="1077">artisan ring, seryll</option>
                <option value="1078">seal ring, seryll</option>
                <option value="1079">dark ring, seryll</option>
                <option value="1080">ring of the Eye, seryll</option>
                <option value="1081">fist bracelet, seryll</option>
                <option value="1082">huge sword bracelet, seryll</option>
                <option value="1083">short sword bracelet, seryll</option>
                <option value="1084">spear bracelet, seryll</option>
                <option value="1085">bracelet of inspiration, seryll</option>
                <option value="1086">soul stealer necklace, seryll</option>
                <option value="1087">artisan necklace, seryll</option>
                <option value="1088">necklace of protection, seryll</option>
                <option value="1089">necklace of focus, seryll</option>
                <option value="1090">necklace of replenishment, seryll</option>
                <option value="1091">metallic liquid</option>
                <option value="1092">left basic shoulder pad, iron</option>
                <option value="1093">left shielding shoulder pad, iron</option>
                <option value="1094">left stylish shoulder pad, gold</option>
                <option value="1095">left layered shoulder pad, steel</option>
                <option value="1097">gift pack, birchwood</option>
                <option value="1098">returner tool chest, birchwood</option>
                <option value="1099">mask of the returner, leather</option>
              </select>
            </div>
            <div class="form-group">
              <label>Quality</label>
              <input type="text" class="form-control" id="txtItemQuality" value="1" placeholder="Item quality" />
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
  
  <script src="<?php echo $rootPath; ?>/assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>

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
              $('#playerImage').prop('src', '../../assets/images/avatars/' + response.image);
              $('#playerName').html(response.NAME);

              switch(response.POWER) {
                case '0':
                  $('#playerPower').html('Player');
                  break;
                case '1':
                  $('#playerPower').html('HERO');
                  break;
                case '2':
                  $('#playerPower').html('GM');
                  break;
                case '3':
                  $('#playerPower').html('High God');
                  break;
                case '4':
                  $('#playerPower').html('Arch GM');
                  break;
                case '5':
                  $('#playerPower').html('Implementor');
                  break;
                default:
                  $('#playerPower').html('Unknown power');
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

        if($(this).text() === "Ban") {
          $('#modalBan').modal('show');
        }
        else {
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {doing: "banFunction", action: 'Unban', wurmID: wurmID},
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

                $('#txtBanDays').val('');
                $('#txtBanReason').val('');
              }

            }
            else {
              swal("Failed to ban!", "We could not proccess this request at this time.", "error");
            }

            $('#modalBanLoader').hide();
            $('#formBanPlayer').show();

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

        if($(this).text() === "Mute") {
          $('#modalMute').modal('show');
        }
        else {
          $.ajax({
            type: 'POST',
            url: 'process.php',
            data: {doing: "muteFunction", action: 'Unmute', wurmID: wurmID},
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
                $('#btnMuteUnmute').text('Mute');
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
          data: {doing: "muteFunction", action: 'Mute', wurmID: wurmID, muteHours: muteHours, muteReason: muteReason},
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
                $('#btnMuteUnmute').text('Unmute');

                $('#txtMuteHours').val('');
                $('#txtMuteReason').val('');
              }

            }
            else {
              swal("Failed to mute!", "We could not proccess this request at this time.", "error");
            }

            $('#modalMuteLoader').hide();
            $('#formMutePlayer').show();
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
                html += '<tr><td>' + response[i].NAME + '</td><td>' + rarity + '</td><td>' + response[i].ORIGINALQUALITYLEVEL + '</td><td>' + response[i].QUALITYLEVEL + '</td></tr>';
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
                  console.log(response);
                  swal("Error", response.error.message, "error");
                  break;
              }
            }
            else if(response.success) {
              if($('#modalAddItem').modal('hide')) {
                $('#txtItemID').multiselect('deselectAll', false);
                $('#txtItemID').multiselect('refresh');
                $('#txtItemID').multiselect('updateButtonText');

                $('#txtItemQuality').val('1');
                $('#txtItemAmount').val('1');

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