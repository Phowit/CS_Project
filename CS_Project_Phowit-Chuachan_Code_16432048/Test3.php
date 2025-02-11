ฟอร์มฉัน <form id="formAuthentication" class="mb-3" action="login.php" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">ชื่อผู้ใช้งาน</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email_username_input"
                    name="email_username_input"
                    placeholder="Enter your email or username"
                    autofocus
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">รหัสผ่าน</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password_input"
                      class="form-control"
                      name="password_input"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> จดจำฉัน </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">เข้าสู่ระบบ</button>
                </div>
              </form>