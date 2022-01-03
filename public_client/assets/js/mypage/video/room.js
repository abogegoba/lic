$(function () {

    'use strict';

    var localStream = null;
    var peer = null;
    var existingCall = null;
    var peerButton = $('.js-peer-button');
    var apiKey = $('#js-video-container').data('api-key');
    var myPeerId = $('#js-video-container').data('my-peer-id');
    var theirPeerId = $('#js-video-container').data('their-peer-id');

    /**
     * 「接続する」ボタンへ切り替える
     */
    var changeConnectPeerButton = function () {
        peerButton.removeClass('js-peer-disconnect');
        peerButton.addClass('js-peer-connect');
        peerButton.val("接続する");
    };

    /**
     * 「面談終了」ボタンへ切り替える
     */
    var changeDisconnectPeerButton = function () {
        peerButton.removeClass('js-peer-connect');
        peerButton.addClass('js-peer-disconnect');
        peerButton.val("面談終了");
    };

    /**
     * PeerCallをハンドリングする
     * @param call
     */
    var setupCallEventHandlers = function (call) {
        // 既存のCallオブジェクトが存在する場合は面談終了
        if (existingCall) {
            existingCall.close();
        }

        // 新しいCallオブジェクトを保持する
        existingCall = call;

        // 接続が確率された場合のハンドリング設定
        call.on('stream', function (stream) {
            // 相手の動画ストリームを画面に表示する
            $('#their-video').get(0).srcObject = stream;
            // 「面談終了」ボタンに切り替える
            changeDisconnectPeerButton();
        });

        // 接続が切断された場合のハンドリング設定
        call.on('close', function () {
            // 相手の動画ストリームを削除する
            $('#' + call.remoteId).remove();
            // 「接続する」ボタンに切り替える
            changeConnectPeerButton();
        });
    };

    // 自身の動画ストリームを保持する
    navigator.mediaDevices.getUserMedia({video: true, audio: true}).then(function (stream) {
        // $('#my-video').get(0).srcObject = stream;
        localStream = stream;
    }).catch(function (error) {
        console.error('mediaDevice.getUserMedia() error:', error);
        return 0;
    });

    // Peerインスタンス作成
    peer = new Peer(myPeerId, {
        key: apiKey,
        debug: 3
    });

    // Peer接続開始ハンドリング設定
    peer.on('open', function () {
        peerButton.show();
    });

    // Peerエラーハンドリング設定
    peer.on('error', function (err) {
        alert("Web面接に接続できませんでした。\n相手からの接続を待つか、しばらく待ってから再度接続してください。");
    });

    // 相手からCallを受け取った場合のハンドリング設定
    peer.on('call', function (call) {
        // 相手のCallに対して自身の動画ストリームを返答する
        call.answer(localStream);
        // PeerCallをハンドリングする
        setupCallEventHandlers(call);
        // 「面談終了」ボタンに切り替える
        changeDisconnectPeerButton();
    });

    // 「接続する」又は「面談終了」ボタン押下時のハンドリング設定
    $(document).on('click', '.js-peer-button', function () {
        if (peerButton.hasClass('js-peer-connect')) {
            const call = peer.call(theirPeerId, localStream);
            setupCallEventHandlers(call);
        } else {
            changeConnectPeerButton();
            existingCall.close();
        }
    });

    // 「接続する」ボタンを表示する
    changeConnectPeerButton();
});