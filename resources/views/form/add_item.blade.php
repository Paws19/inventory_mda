  <div class="modal-overlay" id="addModal" onclick="if(event.target===this)closeModal()">
      <div
          style="background:#fff;border-radius:16px;padding:24px;width:520px;max-height:85vh;overflow-y:auto;position:relative;">
          <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
              <div style="font-size:15px;font-weight:700;color:#0e1e45;">Add New Item</div>
              <button onclick="closeModal()"
                  style="background:none;border:none;cursor:pointer;color:#8a9abf;font-size:18px;">✕</button>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
              <div style="grid-column:1/-1;">
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Item
                      Name</label>
                  <input type="text" name="name" placeholder="e.g. Dell Optiplex 7090"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;"
                      onfocus="this.style.borderColor='#4d9de0'"
                      onblur="this.style.borderColor='rgba(29,53,119,0.18)'" />
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Category</label>
                  <select name="category"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;background:#fff;">
                      <option>Computer Units</option>
                      <option>Peripherals</option>
                      <option>Internal Hardware</option>
                      <option>Networking Equipment</option>
                      <option>Office Equipment</option>
                      <option>Power & Electrical</option>
                      <option>Furniture</option>
                  </select>
              </div>


              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Quantity</label>
                  <input type="number" name="quantity" min="1" value="1"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;"
                      onfocus="this.style.borderColor='#4d9de0'"
                      onblur="this.style.borderColor='rgba(29,53,119,0.18)'" />
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Condition</label>
                  <select name="condition"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;background:#fff;">
                      <option>Working</option>
                      <option>For Repair</option>
                      <option>Defective</option>
                  </select>
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Status</label>
                  <select name="status"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;background:#fff;">
                      <option>Available</option>
                      <option>In Use</option>
                      <option>Borrowed</option>
                  </select>
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Assigned
                      To</label>
                  <input type="text" name="assigned_to" placeholder="e.g. Lab 1, PC #05"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;"
                      onfocus="this.style.borderColor='#4d9de0'"
                      onblur="this.style.borderColor='rgba(29,53,119,0.18)'" />
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Location</label>
                  <input type="text" name="location" placeholder="e.g. Lab 1, Server Room"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;"
                      onfocus="this.style.borderColor='#4d9de0'"
                      onblur="this.style.borderColor='rgba(29,53,119,0.18)'" />
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Date
                      Purchased</label>
                  <input type="date" name="purchase_date"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;"
                      onfocus="this.style.borderColor='#4d9de0'"
                      onblur="this.style.borderColor='rgba(29,53,119,0.18)'" />
              </div>
              <div>
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Warranty
                      Expiry</label>
                  <input type="date" name="warranty_expiration_date"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;"
                      onfocus="this.style.borderColor='#4d9de0'"
                      onblur="this.style.borderColor='rgba(29,53,119,0.18)'" />
              </div>
              <div style="grid-column:1/-1;">
                  <label
                      style="font-size:11px;font-weight:600;color:#8a9abf;display:block;margin-bottom:5px;text-transform:uppercase;letter-spacing:0.8px;">Remarks</label>
                  <textarea placeholder="Any additional notes about this item…" rows="2"
                      style="width:100%;padding:8px 12px;border:1px solid rgba(29,53,119,0.18);border-radius:8px;font-size:12.5px;color:#0e1e45;outline:none;font-family:inherit;resize:none;"
                      onfocus="this.style.borderColor='#4d9de0'" onblur="this.style.borderColor='rgba(29,53,119,0.18)'"></textarea>
              </div>
          </div>
          <div style="display:flex;gap:10px;margin-top:18px;justify-content:flex-end;">
              <button onclick="closeModal()"
                  style="padding:9px 20px;border-radius:8px;background:#f0f4ff;border:1.5px solid rgba(29,53,119,0.12);font-size:12.5px;font-weight:600;color:#8a9abf;cursor:pointer;"
                  onmouseover="this.style.borderColor='#1d3577'"
                  onmouseout="this.style.borderColor='rgba(29,53,119,0.12)'">Cancel</button>
              <button
                  style="padding:9px 24px;border-radius:8px;background:#1d3577;border:none;font-size:12.5px;font-weight:600;color:#fff;cursor:pointer;"
                  onmouseover="this.style.background='#2a4a9e'" onmouseout="this.style.background='#1d3577'">Save
                  Item</button>
          </div>
      </div>
  </div>
