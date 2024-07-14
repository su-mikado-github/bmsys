<template>
  <form>
    <div class="container">
      <div class="d-flex justify-content-center">
        <div class="col-4 card">
          <div class="card-header">ログイン</div>
          <div class="card-body">
            <div class="mb-3">
              <label for="loginId" class="form-label">ID:</label>
              <input id="loginId" type="text" class="form-control" />
              <p v-if="!!loginId?.message" class="text-danger">メッセージ</p>
            </div>
            <div class="mb-3">
              <label for="loginPw" class="form-label">パスワード:</label>
              <input id="loginPw" type="text" class="form-control" />
              <p v-if="!!loginPw?.message" class="text-danger">メッセージ</p>
            </div>
          </div>
          <div class="card-footer">
            <button type="button" class="btn btn-primary" @click="loginIdClick">
              LoginId Click !!
            </button>
            <button type="button" class="btn btn-primary" @click="loginPwClick">
              LoginPw Click !!
            </button>
            <button type="button" class="btn btn-primary" @click="clearClick">
              Clear !!
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script setup lang="ts">
interface IInputField {
  message: string;
}

interface ITextBox extends IInputField {
  //
}

const loginId = useState<ITextBox | null>("loginId", () => null);
const loginPw = useState<ITextBox | null>("loginPw", () => null);

function loginIdClick() {
  loginId.value = { message: "Hello !!" };
}

function loginPwClick() {
  loginPw.value = { message: "Hello !!" };
}

function clearClick() {
  loginId.value = null;
  loginPw.value = null;
}
</script>
