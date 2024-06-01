from flask import Flask, render_template, request
appflask = Flask(__name__)
@appflask.route('/')
def index():
    return render_template('index.html')
@appflask.route('/hello', methods=['POST'])
def hello():
    name = request.form.get('name')
    return render_template('hello.html', name=name)
if __name__ == '__main__':
    appflask.run(debug=True)